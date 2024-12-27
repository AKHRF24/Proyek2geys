<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Market</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Tambah Item Baru</h1>
                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Item -->
                    <div class="mb-3">
                        <label for="NamaItem" class="form-label">Nama Item</label>
                        <input type="text" class="form-control" id="NamaItem" name="nama_items" required>
                    </div>

                    <!-- Point -->
                    <div class="mb-3">
                        <label for="point" class="form-label">Point</label>
                        <input type="number" class="form-control" id="point" name="point" required>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept=".png, .jpg, .jpeg" onchange="previewImg()" required>
                        <img id="preview" class="mt-2" src="#" alt="Preview Foto" style="display: none; max-width: 100px;">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="description" rows="3" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Image Script -->
    <script>
        function previewImg() {
            const input = document.getElementById('foto');
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
