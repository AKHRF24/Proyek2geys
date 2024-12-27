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
                    <th>Nama Item</th>
                    <th>Point</th>
                    <th>Quantity</th>
                    <th>deskripsi</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>