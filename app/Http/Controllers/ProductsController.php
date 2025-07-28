<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Storage;
class ProductsController extends Controller
{
    //
    function AdminProductsF(){
        $getProducts=Product::paginate();
        return view('ProductsPage' , ['Products'=>$getProducts]);
    }
 function ProductsAddAdmin(Request $request){
    try {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->Price = $request->price;
        $product->Stock = $request->stock;
        $product->category = $request->category;
        $product->Submiter_id = Auth::id();

        if ($request->hasFile('images_1')) {
            $image1Path = $request->file('images_1')->store('images', 'public');
            $product->image1 = $image1Path;
        }

   
        if ($request->hasFile('images_2')) {
            $image2Path = $request->file('images_2')->store('images', 'public');
            $product->image2 = $image2Path;
        }

        if ($request->hasFile('images_3')) {
            $image3Path = $request->file('images_3')->store('images', 'public');
            $product->image3 = $image3Path;
        }

        // Save product
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product added successfully!'
        ]);

    } catch (\Exception $e) {
 
        Log::error('Product Add Error: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong while adding the product.'
        ], 500);
    }
}
public function view($id)
{
    $getProduct = Product::findOrFail($id);
    return view('ProductView', ['product' => $getProduct]);
}

    function AdminProductEid($id){
        $getProduct = Product::findOrFail($id);
            return view('ProductEid', ['product' => $getProduct]);
    }



  public function update(Request $request, $id)
{
    try {
        $product = Product::findOrFail($id);

        // بغیر validate کیے request سے data directly assign کریں
        $product->name = $request->name;
        $product->Price = $request->price;
        $product->Stock = $request->stock;
        $product->Category = $request->category;
        $product->status = $request->status;
        $product->description = $request->description;

        // Handle image updates
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete old image if exists
                if ($product->$imageField && Storage::disk('public')->exists($product->$imageField)) {
                    Storage::disk('public')->delete($product->$imageField);
                }
                // Store new image
                $product->$imageField = $request->file($imageField)->store('products', 'public');
            }
        }

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error updating product: ' . $e->getMessage()
        ], 500);
    }
}
 function delete($id)
{
    $product = Product::find($id);
    
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
    }

    $product->delete();

    return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
}



     

    
      function search(Request $request)
{
    $query = $request->input('query');

    $products = Product::where('name', 'LIKE', "%$query%")
        ->orWhere('sku', 'LIKE', "%$query%")
        ->orWhere('category', 'LIKE', "%$query%")
        ->get();

    if ($request->ajax()) {
        return response()->json([
            'products' => $products
        ]);
    }

    return view('ProductsPage', compact('Products'));
}
  function SellerProducts(){
            $getProducts=Product::paginate();
        return view('SellerProducts' , ['Products'=>$getProducts]);
  }

}