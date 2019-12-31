@extends('layouts.app')
@section('content')

        <div class="card-header"> <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Catalogue</h3>


             Pour afficher un produit veuiller cliquez sur son code produit!
                </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div id="azmine"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <b> <h3><div class="card-header">Liste des différents articles</div></h3></b>



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
                                            <td><img width=50% src="{{asset( $product->image )}}"> </td>
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
                            </div>

                            @can('create-products')
                                <a href="{{route('admin.products.create')}}"><button class="btn btn-primary float-right">Nouveau produit</button> </a>
                            @endcan
                            {{$products->links()}}
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
                    const products = response.data.products
                    let results = document.querySelector('#results')
                    results.innerHTML = ''
                    for(let i = 0; i < products.length; i++){
                        let card = document.createElement('div')
                        let cardBody = document.createElement('div')
                        card.classList.add('card', 'mb-3')
                        cardBody.classList.add('card-body')
                        let title = document.createElement('h5')
                        title.classList.add('card-title')
                        title.innerHTML = products[i].name
                        let description = document.createElement('p')
                        description.classList.add('card-text')
                        description.innerHTML = products[i].comment
                        cardBody.appendChild(title)
                        cardBody.appendChild(description)
                        card.appendChild(cardBody)
                        results.appendChild(card)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

        }


    </script>
@endsection



