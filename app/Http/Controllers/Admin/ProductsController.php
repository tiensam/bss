<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Gate;
use App\Product;
use App\Categorie;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\CategorieRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productRepository;
    protected $categorieRepository;

    public function __construct(ProductRepository $productRepository)//nous injectons un gestionnaire de données dans
        //  le contrôleur en plus des deux classes de validation. Ce gestionnaire de données chargé de toutes
        // les actions au niveau de la table des utilisateurs.
    {
        $this->middleware('auth');

        $this->productRepository = $productRepository;
        $this->categorieRepository = new CategorieRepository($categorie = new Categorie());

    }

    public function index()
    {
        //return view('admin.products.index');

        $products = Product::latest()->paginate(5);

        /*foreach ($products as $product){ // pour afficher le nom du type correspondant grace à une correspondance entre la table products (qui contient l'id de la catégorie dans son champs type) et la table catégories
            $product->type = $this->categorieRepository->getById($product->type)->name;
        }*/

        return view('admin.products.index', compact('products'));
    }









    public function search(Request $request)
    {

        $words = $request->words;

        $products = DB::table('products')
            ->where('code_produit','LIKE',"%$words%")
            ->orWhere('type','LIKE',"%$words%")
            ->orderBy('created_at','DESC')
            ->get();
        return response()->json(['success'=> true, 'products'=> $products]);
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $data = Product::search($request->get('full_text_search_query'))->get();

            return response()->json($data);
        }
    }














    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = $this->productRepository->getcategories();
        return view('admin.products.create', compact('categorie'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'code_produit' => 'required',
        ]);

      //  Product::create($request->only(['name', 'code_produit']));
        // Image storing
        //dd($request->all());
        $url = null;
        $file = $request->file('file');
        if(!($file->isValid()))
        {
            return redirect::back()->withErrors(['msg' , 'Désolé mais votre image ne peut pas être envoyée']);
                //->with('error','Désolé mais votre image ne peut pas être envoyée !');
        }
        //$chemin = config('file.path').'/products';
        $chemin = 'uploads\products';

        $extension = $file->getClientOriginalExtension();

        do {
            $nom = Str::Random(10) . '.' . $extension;
        } while(file_exists($chemin . '/' . $nom));

        if($file->move($chemin, $nom)) {
            $url = $chemin . '/' . $nom;
        }
        $inputs = array_merge($request->all());


        $inputs['image'] = $url ;
        Product::create($inputs);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $categorie = $this->productRepository->getcategories();
        $selectedcategorie = $this->categorieRepository->getById($product->type)->name;

        return view('admin.products.edit', compact('product','categorie','selectedcategorie' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required',
            'code_produit' => 'required',
        ]);
        $product->update($request->only(['name', 'body']));
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Gate::denies('delete-products')){ //cette gate verifie si l'utilisateur actuel est admin avant de lui donner accès à la supression
                return redirect()->route('admin.products.index')->with('success', 'Vous n\'êtes pas authorisé à supprimer un article! Merci de contacter un administrateur pour cela.');}
        if (isset($product->image) && file_exists(public_path($product->image)))
        {
            // On ouvre le dossier.
            $repertoire = opendir(public_path('uploads\products'));
            // On lance notre boucle qui lira les fichiers un par un.
            unlink(public_path($product->image));
            closedir($repertoire); // On ferme !
        }
                $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec success!');
    }
}
