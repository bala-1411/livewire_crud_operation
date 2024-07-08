<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductModel; 
use Livewire\WithPagination;



class Products extends Component
{

    use WithPagination;
    public $name, $quantity, $price, $description, $id;
    public $message;
    
    public function createProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        ProductModel::create([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'quantity', 'price', 'description']);

        $this->products = ProductModel::paginate(10);

        session()->flash('message', 'Product Created Successfully.');
    }

 
    
    public function changeMessage()
    {
      // dd("HI");
        $this->message = 'Button Clicked!';
    }

    public function render()
    {
        // Fetch paginated data from the model
        $products = ProductModel::paginate(10); // Adjust the number 10 as per your needs

        return view('livewire.products', [
            'products' => $products,
        ]);
    }

    public function edit($id)
    {
        $product = ProductModel::findOrFail($id);
        $this->id = $product->id;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
    }

    // Method to update the product data
    public function updateProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product = ProductModel::findOrFail($this->id);
        $product->name = $this->name;
        $product->quantity = $this->quantity;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->updated_at = now();
        $product->save();

        session()->flash('message', 'Product Updated Successfully.');
    }


    public function delete($id)
    {
            ProductModel::find($id)->delete();
            session()->flash('message', 'Product Deleted Successfully.');    
    }

}
