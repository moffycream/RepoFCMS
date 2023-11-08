<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodInventory;
use App\Models\Inventory;
use App\Models\MenuFood;
use App\Http\Controllers\ValidationController;

class FoodController extends Controller
{
    // used for verification
    protected $adminController;

    // Retrieve function 
    public function index(AdminController $adminController)
    {
        $food = Food::all();
        $inventories = Inventory::all();
        $menuFoods = MenuFood::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-food', ['listItems' => $food, 'inventories' => $inventories, 'menuFoods' => $menuFoods]);
        } else {
            return view('login.access-denied');
        }
    }

    //Add food form
    public function addFoodForm(AdminController $adminController)
    {
        $inventory = Inventory::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-food-form', ['listItems' => $inventory]);
        } else {
            return view('login.access-denied');
        }
    }

    // Insert function 
    public function registerNewFood(Request $request)
    {
        $validator = app(ValidationController::class);

        $imageErrMsg = "";
        $nameErrMsg = "";
        $descriptionErrMsg = "";
        $priceErrMsg = "";
        $amountErrMsg = "";

        $food = new Food();
        $food->foodID = $request->foodID;

        //Image
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $fileName, 'addFood');
            $food->imagePath = 'food-images/' . $path;
        } else {
            $imageErrMsg .= "The image field is required.";
        }

        //Name
        if ($request->filled('name')) {
            if ($validator->validateText($request->name, '/^.{0,20}$/')) {
                $food->name = $request->name;
            } else {
                $nameErrMsg .= "The name must be less than 20 characters.";
            }
        } else {
            $nameErrMsg .= "The name field is required.";
        }

        //Description
        if ($request->filled("description")) {
            if ($validator->validateText($request->description, '/^.{0,80}$/')) {
                $food->description = $request->description;
            } else {
                $descriptionErrMsg .= "The description must be less than 80 characters.";
            }
        } else {
            $descriptionErrMsg .= "The description field is required.";
        }

        //Price
        if ($request->filled("price")) {
            if ($validator->validateText($request->price, '/^\d{1,8}(\.\d{1,2})?$/')) {
                $food->price = $request->price;
            } else {
                $priceErrMsg .= "The price must be less than 8 digits.";
            }
        } else {
            $priceErrMsg .= "The price field is required.";
        }

        //Amount
        $allAmountIsFilled = false;
        $atLeastOneAmountIsGreaterThanZero = false;
        if (isset($request->amount)) {
            foreach ($request->amount as $amount) {
                if ($amount !== null || $amount !== "") {
                    $allAmountIsFilled = false;
                }
                if ($amount > 0) {
                    $atLeastOneAmountIsGreaterThanZero = true;
                }
            }
            if ($allAmountIsFilled == false) {
                $amountErrMsg .= "The amount field is required.";
            }
            if ($atLeastOneAmountIsGreaterThanZero == false) {
                $amountErrMsg .= "At least one amount must be greater than 0.";
            }
        } else {
            $amountErrMsg .= "The amount field is required.";
        }
        $foods = Food::all();
        $inventories = Inventory::all();
        $menuFoods = MenuFood::all();

        //If all fields are valid
        if ($imageErrMsg == "" && $nameErrMsg == "" && $descriptionErrMsg == "" && $priceErrMsg == "" && $amountErrMsg == "") {
            $food->save();

            $inventoryIDs = $request->inventoryID;
            $amounts = $request->amount;
            $inventoryData = array_combine($inventoryIDs, $amounts);

            $foodInventoryController = new FoodInventoryController();

            foreach ($inventoryData as $inventoryID => $amount) {
                $foodInventoryController->registerNewFoodInventory($request, $food->foodID, $inventoryID, $amount);
            }

            return redirect('/add-food')->with(['listItems' => $foods, 'inventories' => $inventories, 'menuFoods' => $menuFoods]);
        } else {
            return view('menu.add-food-form')->with(['listItems' => $inventories])
                ->with('imageErrMsg', $imageErrMsg)
                ->with('nameErrMsg', $nameErrMsg)
                ->with('descriptionErrMsg', $descriptionErrMsg)
                ->with('priceErrMsg', $priceErrMsg)
                ->with('amountErrMsg', $amountErrMsg)
                ->with('image', $request->image)
                ->with('name', $request->name)
                ->with('description', $request->description)
                ->with('price', $request->price);
        }
    }

    // Edit Food
    public function editFood(Request $request)
    {
        $food = Food::find($request->foodID);

        $validator = app(ValidationController::class);

        $nameErrMsg = "";
        $descriptionErrMsg = "";
        $priceErrMsg = "";
        $amountErrMsg = "";

        //image validation
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $fileName, 'addFood');
            $food->imagePath = 'food-images/' . $path;
        }

        //Name validation
        if ($request->filled('name')) {
            if ($validator->validateText($request->name, '/^.{0,20}$/')) {
                $food->name = $request->name;
            } else {
                $nameErrMsg .= "The name must be less than 20 characters.";
            }
        } else {
            $nameErrMsg .= "The name field is required.";
        }

        //Description validation
        if ($request->filled("description")) {
            if ($validator->validateText($request->description, '/^.{0,80}$/')) {
                $food->description = $request->description;
            } else {
                $descriptionErrMsg .= "The description must be less than 80 characters.";
            }
        } else {
            $descriptionErrMsg .= "The description field is required.";
        }

        //Price validation
        if ($request->filled("price")) {
            if ($validator->validateText($request->price, '/^\d{1,8}(\.\d{1,2})?$/')) {
                $food->price = $request->price;
            } else {
                $priceErrMsg .= "The price must be less than 8 digits.";
            }
        } else {
            $priceErrMsg .= "The price field is required.";
        }

        //Amount validation
        $allAmountIsFilled = true;
        $atLeastOneAmountIsGreaterThanZero = false;
        foreach ($request->amount as $amount) {
            if ($amount === null || $amount === "") {
                $allAmountIsFilled = false;
            }
            if ($amount > 0) {
                $atLeastOneAmountIsGreaterThanZero = true;
            }
        }
        if ($allAmountIsFilled == false) {
            $amountErrMsg .= "The amount field is required.";
        }
        if ($atLeastOneAmountIsGreaterThanZero == false) {
            $amountErrMsg .= "At least one amount must be greater than 0.";
        }


        $foods = Food::all();
        $inventories = Inventory::all();
        $menuFoods = MenuFood::all();

        //If all fields are valid
        if ($nameErrMsg == "" && $descriptionErrMsg == "" && $priceErrMsg == "" && $amountErrMsg == "") {
            $food->save();

            //Find food record
            $foodInventory = FoodInventory::where('foodID', '=', $request->foodID)->get();

            //Calculate the total amount of food inventory
            $foodInventoryCount = count($foodInventory);

            //Update food record that already exist
            for ($i = 0; $i < $foodInventoryCount; $i++) {
                $foodInventory[$i]->amount = $request->amount[$i];
                $foodInventory[$i]->save();
            }

            //Add new food inventory record if it is not exist
            $foodInventoryController = new FoodInventoryController();

            for ($i = $foodInventoryCount; $i < count($request->amount); $i++) {
                $foodInventoryController->registerNewFoodInventory($request, $food->foodID, $request->inventoryID[$i], $request->amount[$i]);
            }

            return redirect('/add-food')->with(['listItems' => $foods, 'inventories' => $inventories, 'menuFoods' => $menuFoods]);
        } else {
            return view('menu.add-food')->with(['listItems' => $foods, 'inventories' => $inventories, 'menuFoods' => $menuFoods])
                ->with('editNameErrMsg', $nameErrMsg)
                ->with('editDescriptionErrMsg', $descriptionErrMsg)
                ->with('editPriceErrMsg', $priceErrMsg)
                ->with('editAmountErrMsg', $amountErrMsg)
                ->with('editName', $request->name)
                ->with('editDescription', $request->description)
                ->with('editPrice', $request->price);
        }
        // $food = Food::find($request->foodID);

        // if ($request->hasFile('image')) {
        //     $fileName = time() . $request->file('image')->getClientOriginalName();
        //     $path = $request->file('image')->storeAs('', $fileName, 'addFood');
        //     $food->imagePath = 'food-images/' . $path;
        // }

        // $food->name = $request->name;
        // $food->description = $request->description;
        // $food->price = $request->price;
        // $food->save();

        // $foodInventory = FoodInventory::where('foodID', '=', $request->foodID)->get();

        // $foodInventoryCount = count($foodInventory);
        // for ($i = 0; $i < $foodInventoryCount; $i++) {
        //     $foodInventory[$i]->amount = $request->amount[$i];
        //     $foodInventory[$i]->save();
        // }

        // //Add new food inventory record
        // $foodInventoryController = new FoodInventoryController();

        // for ($i = $foodInventoryCount; $i < count($request->amount); $i++) {
        //     $foodInventoryController->registerNewFoodInventory($request, $food->foodID, $request->inventoryID[$i], $request->amount[$i]);
        // }

        // return redirect('/add-food');
    }

    // Delete Food
    public function deleteFood($foodID)
    {
        Food::find($foodID)->delete();

        return redirect('/add-food');
    }
}
