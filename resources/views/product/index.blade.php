@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h4 class="head-label">Produtos</h4>

            <div class="dt-action-buttons">
                <a class="btn btn-primary" href="{{ route('product.create') }}"> Cadastrar produto </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th class="">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nome }}</td>
                                <td>{{ $product->preco }}</td>
                                <td>
                                    <a class="btn btn-outline-primary border-0 me-5" href="">
                                        <span class="tf-icons bx bx-edit bx-22px me-2"></span>
                                        Editar
                                    </a>
                                    <a class="btn btn-outline-danger border-0 " href="">
                                        <span class="tf-icons bx bx-trash bx-22px me-2"></span>
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
