<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Product Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <x-nav-layout>
    Laravel CRUD Create Page
  </x-nav-layout>

  <div class="container">

    <div class="row justify-content-center mt-4">
      <div class="col-md-10 d-flex justify-content-end">
        <a href="{{route('products.index')}}" class="btn btn-outline-primary">Back</a>
      </div>
    </div>

    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card border-0 shadow-lg my-3">
          <div class="card-header bg-dark">
            <h3 class="text-white">Create Product</h3>
          </div>

          <form enctype="multipart/form-data" action="{{route('products.store')}}" method="post">
            @csrf

            <div class="card-body">
              <div class="mb-3">
                <label for="" class="form-label h5">Name</label>
                <input type="text" name="name" value="{{old('name')}}" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name">
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Sku</label>
                <input type="text" name="sku" value="{{old('sku')}}" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="Sku">
                @error('sku')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Price</label>
                <input type="text" name="price" value="{{old('price')}}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price">
                @error('price')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label h5">Description</label>
                <textarea name="description" placeholder="Description" class="form-control">{{old('description')}}</textarea>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control form-control-lg" placeholder="Image" name="image">
              </div>

              <div class="d-grid">
                <button class="btn btn-lg btn-primary">Submit</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>

</html>