<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/salary" class="btn btn-primary">Go Back</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Employee Salary Details</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Month</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="salary in filterSearch" :key="salary.id">
										<td>{{ salary.first_name }}</td>
										<td>{{ salary.salary_month }}</td>
										
										<td>{{ salary.amount}}</td>
										<td>{{ salary.salary_date }}</td>
										<td>
										<router-link :to="{name:'edit-salary',params:{id:salary.id}}" class="btn btn-sm btn-primary">Edit Salary</router-link>
											
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
			salaries:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.salaries.filter(salary=>{
				return salary.first_name.match(this.searchTerm)
			})
		}
	},
	methods: {
		viewSalary(){
			let id=this.$route.params.id			
		    axios.get('/api/salary/view/'+id)
			.then(({data})=>(this.salaries=data))
			.catch(error=>this.errors=error.response.data.errors)
		}


	},
	created(){

    	this.viewSalary()

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