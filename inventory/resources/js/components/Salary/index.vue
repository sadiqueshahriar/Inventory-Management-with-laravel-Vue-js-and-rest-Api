<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Salary Details</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Month Name</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="salary in filterSearch" :key="salary.id">
										<td>{{ salary.salary_month }}</td>

										<td>
										<router-link :to="{name:'view-salary',
                                        params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>					
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
				return salary.salary_month.match(this.searchTerm)
			})
		}
	},
	methods: {
		allsalaries(){
			axios.get('/api/salary')
			 .then(({data})=>(this.salaries=data))		
			.catch()
		}


	},
	created(){
    	this.allsalaries()
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