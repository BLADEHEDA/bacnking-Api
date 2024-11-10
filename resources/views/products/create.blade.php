<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create Product</h1>
    <div class="">
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error )
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('product.store') }}">
        @csrf
        @method('post')
        <div class="">
            <label>name</label> 
            <input placeholder="enter name" name="name" type="text">
        </div>
        <div class="">
            <label>Qty</label>
            <input placeholder="enter Qty" name="qty" type="text">
        </div>
        <div class="">
            <label>price</label>
            <input placeholder="enter price" name="price" type="text">
        </div>

        <div class="">
            <label>Description</label>
            <input placeholder="enter description" name="description" type="text">
        </div>
        <div class="">
            <input type="submit" value="Save a New Product">
        </div>
       
    </form>
</body>
</html>