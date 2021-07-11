<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-supplier" class="btn btn-primary">Add Supplier</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Supplier List</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Phone</th>
										<th>Photo</th>
										<th>Email</th>
										<th>Shop Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="supplier in filterSearch" :key="supplier.id">
										<td>{{ supplier.name }}</td>
										<td>{{ supplier.phone }}</td>
										<td><img :src="supplier.photo" id="img" ></td>
										<td>{{ supplier.email }}</td>
										<td>{{ supplier.shopname }}</td>
										<td>
										<router-link :to="{name:'edit-supplier',params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="supplierDelete(supplier.id)" class="btn btn-sm btn-danger">Delete</a>	
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
			Suppliers:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.Suppliers.filter(Supplier=>{
				return Supplier.name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allSupplier(){
			axios.get('/api/supplier')
			 .then(({data})=>(this.Suppliers=data))		
			.catch()
		},
		supplierDelete(id){

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
				axios.delete('/api/supplier/'+id)
				.then(()=>{
					this.Suppliers=this.Suppliers.filter(Supplier=>{
						return Supplier.id != id
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

    	this.allSupplier()

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