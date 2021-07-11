<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Product List</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Code</th>
										<th>Photo</th>
										<th>Category</th>
										<th>Buying Price</th>
										<th>Selling Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="product in filterSearch" :key="product.id">
										<td>{{ product.product_name }}</td>
										<td>{{ product.product_code }}</td>
										<td><img :src="product.image" id="img" ></td>
										<td>{{ product.category_name }}</td>
										<td>{{ product.buying_price }}</td>
										<td>{{ product.selling_price }}</td>
										<td>
										<router-link :to="{name:'edit-product',params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="productDelete(product.id)" class="btn btn-sm btn-danger">Delete</a>	
										</td>
									</tr>							
								</tbody>

							</table>
						</div>
					</div>
				</div>


			</div>
		
 
    </div>
</template>
<script>
export default {
    created(){
		if(!User.loggedIn()){
			this.$router.push({name:'/'})
		}
	},
	data(){
		return{
			products:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.products.filter(product=>{
				return product.product_name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allProduct(){
			axios.get('/api/product')
			 .then(({data})=>(this.products=data))		
			.catch()
		},
		productDelete(id){

			Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			if (result.value) {
				axios.delete('/api/product/'+id)
				.then(()=>{
					this.products=this.products.filter(product=>{
						return product.id != id
					})
				})
				.catch(error=>this.errors=error.response.data.errors)		
				Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
				)
			  }
			})
				

		}

	},
	created(){

    	this.allProduct()

       }
}
</script>

<style>
    
    #img{
        height: 40px;
		width: 40px;
    }
	.search{
		float: right;
	}
</style>