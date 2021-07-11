<template>
 <div>
 				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
                 <router-link to="/given-salary" class="btn btn-primary button">All Employee</router-link>
						</div>

					</div>
				</div>

    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Employee Salary Information</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Pay Salary</h5>
								</div>
								<hr>
								<form class="row g-3" @submit.prevent="salaryPaid">
									<div class="col-md-6">
										<label for="inputFirstName" class="form-label"> Name</label>
										<input type="text" class="form-control" id="inputFirstName" v-model="form.first_name">

									</div>

									<div class="col-md-6">
										<label for="inputEmail" class="form-label">Email</label>
										<input type="email" class="form-control" id="inputEmail" v-model="form.email">

									</div>

  									<div class="col-md-6">
                                    <label class="form-label">Month</label>
									<select class="form-control" v-model="form.salary_month">
										<option value="January" >January</option>
										<option value="February" >February</option>
										<option value="March" >March</option>
										<option value="April" >April</option>
										<option value="May" >May</option>
										<option value="June" >June</option>
										<option value="July" >July</option>
										<option value="August" >August</option>
										<option value="September" >September</option>
										<option value="Octber" >Octber</option>
										<option value="November" >November</option>
										<option value="December" >December</option>
                                    </select>									

									</div>                                  

									<div class="col-md-6">
										<label for="inputSalary" class="form-label">Salary</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.salary">
	
									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5" >PayNow</button>
									</div>
								</form>
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
			form:{
				first_name:"",
				email:"",
				salary_month:"",	
				salary:""

			}
	
		}
		

	},
    created(){
        let id=this.$route.params.id
        axios.get('/api/employee/'+id)
        .then(({data})=>(this.form=data))
        .catch(console.log('error'))
    },	
	methods: {
        salaryPaid(){
			 let id=this.$route.params.id			
		    axios.post('/api/salary/paid/'+id,this.form)
			.then(()=>{			
			 this.$router.push({name:'given-salary'})
             Notification.success()

			})
			.catch(error=>this.errors=error.response.data.errors)

        }
		
	}

    
}
</script>

<style>
    
    .button{
    margin-right: 90px;
    margin-top: 26px;
    }
</style>