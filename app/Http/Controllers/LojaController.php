<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;

class LojaController extends Controller
{
    public function index(Request $request)
    {
        $tipos = Type::all();

        $query = Product::where('quantity', '>', 0)
                        ->where('price', '>', 0);

        // filtro por categoria
        if ($request->tipo_id != '') {
            $query->where('type_id', $request->tipo_id);
}

        // busca por nome E DESCRIÇÃO
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->busca . '%')
            ->orWhere('description', 'like', '%' . $request->busca . '%');
});

        $produtos = $query->get();

        return view('welcome', compact('produtos', 'tipos'));
    }
}
