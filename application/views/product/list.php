
<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					Products
					<a class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#productModal"> Create</a>
				</div>
				<div class="card-body">
					<table id="productTable" class="table table-bordered">
						<thead>
						<tr>
							<th>ID</th>
							<th>Adı</th>
							<th>İşlemler</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($products as $product){?>
						<tr>
							<td><?= $product->id;?></td>
							<td><?= $product->name;?></td>
							<td>
								<a class="btn btn-warning" href="<?=base_url()?>product/edit/<?=$product->id?>">Düzenle</a>
								<a class="btn btn-danger" onclick="delProduct(<?=$product->id?>)">Sil</a>
							</td>
						</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="productModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Product Create</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label for="name" class="label">Name</label>
				<input type="text" id="name" class="form-control" name="name">
				<label for="product" class="product">Ingredients </label><br>
				<?php foreach ($products as $product){?>
				<input type="checkbox" id="products" name="products[]" value="<?=$product->id;?>"><label><?=$product->name;?></label><br>
				<?php }?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
				<button type="button" class="btn btn-primary" onclick="saveProduct()">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>
	function saveProduct(){
		if ($("#name").val().length == 0) {
			swal("Name not entered");
		} else {
			var array = [];
			$('#products:checked').each(function() {
				array.push($(this).val());
			});

			$.ajax({
				method: "POST",
				url: "<?=base_url()?>product/create",
				data: {
					name: $("#name").val(),
					products: array
				},
				success: function (data) {
					data = JSON.parse(data);
					if (data['success']) {
						swal('Başarılı')
						location.reload()
					} else {
						swal('Hata Oluştu')
					}
				}
			});

		}
	}

	function delProduct(id){
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this imaginary file!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
			.then((willDelete) => {
				if (willDelete) {

					$.ajax({
						method: "POST",
						url: "<?=base_url()?>product/delete",
						data: {
							id: id
						},
						success: function (data) {
							data = JSON.parse(data)

							if (data['success']) {
								swal("Poof! Your imaginary file has been deleted!", {
									icon: "success",
								});
							} else {
								swal('An error occured!')
							}

							location.reload()
						}
					})


				} else {
					swal("Your imaginary file is safe!");
				}
			});
	}
</script>
