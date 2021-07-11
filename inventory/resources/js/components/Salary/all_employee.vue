<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/salary" class="btn btn-primary">All Payments</router-link>
							 
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
										<router-link :to="{name:'pay-salary',params:{id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
											
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