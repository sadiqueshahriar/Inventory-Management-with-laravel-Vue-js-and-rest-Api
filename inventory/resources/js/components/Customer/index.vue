<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-customer" class="btn btn-primary">Add Customer</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Customer List</b></h6>
					
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
										<th>Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="customer in filterSearch" :key="customer.id">
										<td>{{ customer.name }}</td>
										<td>{{ customer.phone }}</td>
										<td><img :src="customer.photo" id="img" ></td>
										<td>{{ customer.email }}</td>
										<td>{{ customer.address }}</td>
										<td>
										<router-link :to="{name:'edit-customer',params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="customerDelete(customer.id)" class="btn btn-sm btn-danger">Delete</a>	
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
			customers:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.customers.filter(customer=>{
				return customer.name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allCustomer(){
			axios.get('/api/customer')
			 .then(({data})=>(this.customers=data))		
			.catch()
		},
		customerDelete(id){

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
				axios.delete('/api/customer/'+id)
				.then(()=>{
					this.customers=this.customers.filter(customer=>{
						return customer.id != id
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

    	this.allCustomer()

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