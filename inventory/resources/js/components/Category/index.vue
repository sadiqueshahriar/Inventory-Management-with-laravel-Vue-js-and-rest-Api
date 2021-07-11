<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-category" class="btn btn-primary">Add Category</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Category List</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Category Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="category in filterSearch" :key="category.id">
										<td>{{ category.category_name }}</td>
																			
										<td>
										<router-link :to="{name:'edit-category',params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="categoryDelete(category.id)" class="btn btn-sm btn-danger">Delete</a>	
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
			categories:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.categories.filter(category=>{
				return category.category_name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allCategory(){
			axios.get('/api/category')
			 .then(({data})=>(this.categories=data))		
			.catch()
		},
		categoryDelete(id){

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
				axios.delete('/api/category/'+id)
				.then(()=>{
					this.categories=this.categories.filter(category=>{
						return category.id != id
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

    	this.allCategory()

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