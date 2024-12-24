@extends('admin.layouts.index')

@section('content')
<div class="card rounded-full">
    <div class="card-header bg-transparent d-flex justify-content-between">
        <button class="btn btn-info" id="addData">
            <i class="fa fa-plus">
                <span>Tambah Product</span>
            </i>
        </button>
        <input type="text" wire:model="search" class="form-control w-25" placeholder="Search....">
    </div>
    <div class="card-body">
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Date In</th>
                    <th>Product Name</th>
                    <th>Point</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td colspan="9">Belum ada barang</td>
                </tr>
                <tr class="align-middle">
                    <td></td>
                    <td>
                        <img src="" style="width:100px;">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        {{-- <input type="hidden" id="sku" value="">
                        <button class="btn btn-info editModal" data-id="">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger deleteData " data-id="">
                            <i class="fas fa-trash-alt"></i>
                        </button> --}}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination d-flex flex-row justify-content-between">
            <div class="showData">
                {{-- Data ditampilkan {{ $data->count() }} dari {{ $data->total() }} --}}data ada berapa
            </div>
            <div>
                {{-- {{ $data->links() }} --}}untuk memindahkan page
            </div>
        </div>
    </div>
</div>
<div class="tampilData" style="display: none;"></div>
<div class="tampilEditData" style="display: none;"></div>
@endsection
