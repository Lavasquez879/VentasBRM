@extends('layouts.app')
@section('content')
<section class="container">
	<div class="row">
		<article class="col-md-12">
		<?php if(Auth::user()){  ?>
			<input type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#registerProduct"
				value="Crear Producto"
			/>
			<input type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#registerInventory"
				value="Registrar Inventario"
			/>
	<?php	}else { ?>
			<input type="submit" class="btn btn-primary btn-lg btn-block" onclick="verPedido()"
				value="Ver pedido"
			/><?php } ?>
			<div class="modal fade" id="registerProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="registerProduct">Crear Productos</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
							<label>{{ __('Nombre Producto') }}</label>
							<input class="form-control" type="text" name="name" id="name" />
							</div>
							<div class="form-group">
							<label> {{ __('Descripción Producto') }}</label>
							<input class="form-control" type="text" name="description" id="description" />
							</div>

						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="Registrar" onclick="addProduct()">	
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="registerInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="registerProduct">Registrar en Inventario</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="form-group">
								<label>Producto</label>
								<select class="browser-default custom-select" name="product_id" id="product_id"> 
									@foreach($products as $product)
									<option value="{{$product->id}}">{{$product->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>{{ __('Cantidad') }}</label>
								<input class="form-control" type="number" name="quantity" id="quantity" />
							</div>
							<div class="form-group">
								<label>Lote</label>
								<input class="form-control" type="number" name="lotNumber" id="lotNumber" />
							</div>
							<div class="form-group">
								<label>{{ __('Fecha de Vencimiento') }} </label>
								<input class="form-control" type="date" name="expirationDate" id="expirationDate" />
							</div>
							<div class="form-group">
								<label>{{ __('Precio Unidad') }}</label>
								<input class="form-control" type="number" name="price" id="price" />
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="Registrar" onclick="addInventory()">	
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="container contenedor">
			@foreach($inventory as $inventoryProduct)
			<?php if($inventoryProduct->quantity>0){?>
			<div class="product">
				<h3 align="center"><strong>{{ $inventoryProduct->product->name }}</strong></h3>
				<h5>{{ __('Proveedor:') }}{{ $inventoryProduct->user->name }}</h5>
				<h5>{{ __('Cantidad Disponible:') }}{{ $inventoryProduct->quantity }}</h5>
				<h5>{{ __('Lote:') }}{{ $inventoryProduct->lot_number }}</h5>
				<h5>fecha vencimiento{{ __('Fecha de vencimiento:') }}{{ $inventoryProduct->expiration_date }}</h5>
				<h5> {{ __('Precio Unidad:') }}{{ $inventoryProduct->price }}</h5>
				<?php if(Auth::user()){?>
				<?php }else{ ?>
				<div class="add">
				<input type="submit" class="btn btn-primary btn-sm" onclick="quanAdd({{$inventoryProduct}})" value="Añadir a la lista">
				</div>
				<?php } ?>
			</div>
			<?php }else{} ?>
			@endforeach
			</div>
			<div class="modal fade" id="car" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Factura</h3>
							<div id="nP"></div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="detailCar"></div>
							<input type="hidden" id="idPCant" name="idPCant">
							<input type="hidden" id="priceFinal" name="priceFinal">
							<div>
							</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="Finalizar Compra" onclick="registerInvoice()">	
							<input type="submit" class="btn btn-primary" value="Cancelar Compra" onclick="cancelInvoice()">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="cantProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Cantidad por Producto</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div center class="modal-body">
							<label>Cantidad</label>
							<input type="hidden" id="idProduct">
							<input class="form-control" type="number" id="orderQuantity">
						</div>
						<input type="submit" class="btn btn-primary" value="Agregar" onclick="addCar()">	
					</div>
				</div>
			</div>

		</article>
	</div>
</section>
@endsection
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	var listCar=[];
	var detailProduct = '';
	var detailProducts = '';
	var priceMoment = 0;
	function addProduct(){
		var name =document.getElementById('name').value;
		var description= document.getElementById('description').value;
  		var url = "product/create";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: { "_token": $("meta[name='csrf-token']").attr("content"),"name":name,"description":description}, 
           success: function(data)             
           {
          window.location.href="/"
            

           }
       });
	}
	function addInventory(){
		  var url = "inventory/create";
		  var product_id=document.getElementById('product_id').value;
		  var quantity= document.getElementById('quantity').value;
		  var lotNumber=document.getElementById('lotNumber').value;
		  var expirationDate= document.getElementById('expirationDate').value;
		  var price = document.getElementById('price').value;
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: { "_token": $("meta[name='csrf-token']").attr("content"),product_id,quantity,lotNumber,expirationDate,price}, 
           success: function(data)             
           {
          window.location.href="/"
              

           }
       });
	}
	function quanAdd(product){		
		$("#cantProduct").modal();
		document.getElementById('idProduct').value= product.id;
		detailProduct= product;
	//	cantP.innerHTML='<select>'+ for(var i=0 ; i <= quantity; i++){
	//	+'<option>'+ i + '</option>'+	
	//	;}+'</select>';
	}
	function addCar(){
		var listProd={};
		listProd['id']=parseInt(document.getElementById('idProduct').value,10) ;
		listProd['quantity']=parseInt(document.getElementById('orderQuantity').value,10) ;
		listCar.push(listProd);
		detailProducts = detailProducts + '<div><h3><strong> '+detailProduct.product.name+'</strong><h3><h6>precio unidad: '+detailProduct.price+'</h6><h6>cantidad: '+listProd['quantity']+'</h6></div>';
		priceMoment +=  (detailProduct.price*listProd['quantity']);

	}
	function verPedido(){
		$("#car").modal();
		console.log(listCar);
		document.getElementById('detailCar').innerHTML=detailProducts+'<div><h6 align="right"><strong>total a pagar '+priceMoment+'</strong></h6></div>';

	}

	function registerInvoice(){    
        var url = "sale/create";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: { "_token": $("meta[name='csrf-token']").attr("content"),"listCar":listCar,"priceFinal":priceMoment}, 
           success: function(data)             
           {
              console.log(data);

           }
       });
	}
	function cancelInvoice(){
		priceMoment = 0;
		detailProducts='';
	}
</script>