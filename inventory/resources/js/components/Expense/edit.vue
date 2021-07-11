<template>
 <div>
 				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
                 <router-link to="/expense" class="btn btn-primary button">All Expense</router-link>
						</div>

					</div>
				</div>

    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Expense Information</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Expense Update</h5>
								</div>
								<hr>
								<form class="row g-3" @submit.prevent="expenseUpdate">
									<div class="col-12">
										<label for="inputcategoryname" class="form-label">Expense Details</label>
                                        <textarea class="form-control" id="inputAddress" rows="2" v-model="form.details"></textarea> 
									</div>
                                    <div class="col-12">
  										<label for="inputamount" class="form-label">Amount</label>
										<input type="text" class="form-control" id="inputamount" v-model="form.amount">										                                     
                                    </div>								
		
	

									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5" >Update</button>
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
                details :"",
                amount:""

			}
	
		}
		

	},
    created(){
        let id=this.$route.params.id
        axios.get('/api/expense/'+id)
        .then(({data})=>(this.form=data))
        .catch(console.log('error'))
    },	
	methods: {

        expenseUpdate(){
			 let id=this.$route.params.id			
		    axios.patch('/api/expense/'+id,this.form)
			.then(()=>{
			
			 this.$router.push({name:'expense'})
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