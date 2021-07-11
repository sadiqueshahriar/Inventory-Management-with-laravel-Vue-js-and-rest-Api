<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-employee" class="btn btn-primary">Add Employee</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Employee List</b></h6>
					
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
										<th>Starting date</th>
										<th>Salary</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="employee in filterSearch" :key="employee.id">
										<td>{{ employee.first_name }}</td>
										<td>{{ employee.phone }}</td>
										<td><img :src="employee.photo" id="img" ></td>
										<td>{{ employee.joining_date }}</td>
										<td>{{ employee.salary }}</td>
										<td>
										<router-link :to="{name:'edit-employee',params:{id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="employeeDelete(employee.id)" class="btn btn-sm btn-danger">Delete</a>	
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
			employees:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.employees.filter(employee=>{
				return employee.first_name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allEmployee(){
			axios.get('/api/employee')
			 .then(({data})=>(this.employees=data))		
			.catch()
		},
		employeeDelete(id){

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
				axios.delete('/api/employee/'+id)
				.then(()=>{
					this.employees=this.employees.filter(employee=>{
						return employee.id != id
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

    	this.allEmployee()

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