@extends('layouts.admin')
@section('content')

        <div class="card-header"> <div class="panel panel-primary">
                <div class="panel-heading">

                </div>
        <div class="card-body">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <b> <div class="card-header"><h3>Liste des différents articles</h3>Pour voir les détails d'un produit, cliquez sur son code produit!</div></b>



                            <form method="POST" action="{{ route('admin.products.search') }}" onsubmit="search(event)" id="searchForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="words" placeholder="Search">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>

                            <div id="results">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>

                                        <th>Code Produit</th>
                                        <th>Type</th>
                                        <th>Désignation</th>
                                        <th>Code Douanier</th>
                                        <th>fournisseur</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $key => $product)
                                        <tbody>
                                        <tr>
                                            <td> <h4><a href="{{ route('admin.products.show',$product->id) }}"> {{ $product->code_produit }} </a></h4></td>
                                            <td> <h4>{{ $product->type }} </h4></td>
                                            <td> <h4>{{ $product->designation }}</h4> </td>
                                            <td> <h4>{{ $product->code_douanier }}</h4> </td>
                                            <td> <h4>{{ $product->fournisseur }}</h4> </td>
                                            <td><img width=20% src="{{asset( $product->image )}}"> </td>
                                            <td><a class="btn btn-warning btn-sm" href="{{ route('admin.products.edit',$product->id) }}">Editer</a>
                                                @can('delete-users') <form
                                                        action="{{ route('admin.products.destroy',$product->id) }}"
                                                        method="POST"
                                                        style="display: inline;"

                                                >
                                                    @csrf @method('DELETE')

                                                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ce produit?')" class="btn btn-danger btn-sm">
                                                        Supprimer
                                                    </button>
                                                </form>
                                                @endcan


                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                    @can('create-products')
                                        <br/><a href="{{route('admin.products.create')}}"><button class="btn btn-primary btn-sm float-right">Nouveau produit</button> </a>
                                    @endcan
                                </table>
                                {{$products->links()}}
                            </div>

                            @can('create-products')
                                <a href="{{route('admin.products.create')}}"><button class="btn btn-primary float-right">Nouveau produit</button> </a>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
            </div>
        </div>

@endsection


@section('extra-js')
    <script>
        function search(event) {
            event.preventDefault()
            const words = document.querySelector('#words').value
            const url = document.querySelector('#searchForm').getAttribute('action')
            axios.post(`${url}`, {
                words: words,
            })
                .then(function (response) {
                    const products = response.data.products;
                    let results = document.querySelector('#results');
                    results.innerHTML = '';
                    for(let i = 0; i < products.length; i++){

                        let card = document.createElement('div');
                        let cardBody = document.createElement('div');
                        let cardimg = document.createElement('div');
                        card.classList.add('card', 'mb-3');
                        cardBody.classList.add('card-body');
                        cardimg.classList.add('card-body');
                        let title = document.createElement('h5');
                        title.classList.add('card-title');
                        title.innerHTML = products[i].name;
                        let description = document.createElement('p');
                        description.classList.add('card-text');
                        description.innerHTML = products[i].comment;
                        let photo = document.createElement('IMG');
                        photo.setAttribute("src", "C:/xampp/htdocs/bss/public/uploads/products/dnCsTku4le.PNG");
                        //photo.setAttribute("src", "C:\\xampp\\htdocs\\bss\\public\\uploads\\produts\\dnCsTku4le.PNG");
                        //photo.setAttribute("src", "C:\\xampp\\htdocs\\bss\\public\\" + products[i].image);//https://www.w3schools.com/jsref/img_pulpit.jpg
                        photo.setAttribute("width", "304");
                        photo.setAttribute("height", "228");
                        photo.setAttribute("alt", products[i].name);
                        //let asset = 'C:\\xampp\\htdocs\\bss\\public\\' + products[i].image; //'C:\\xampp\\htdocs\\bss\\public\\';
                        //photo.src = asset;
                        cardBody.appendChild(title);
                        cardBody.appendChild(description);
                        cardimg.appendChild(photo);
                        card.appendChild(cardBody);
                        card.appendChild(cardimg);
                        results.appendChild(card);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

        }


    </script>
@endsection



