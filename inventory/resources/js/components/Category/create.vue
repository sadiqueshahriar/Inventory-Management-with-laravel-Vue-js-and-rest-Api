<template>
 <div>
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
                 <router-link to="/category" class="btn btn-primary button">All Category</router-link>
						</div>

					</div>
				</div>

    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Category Information</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Add Category</h5>
								</div>
								<hr>
								<form class="row g-3" enctype="multipart/form-data" @submit.prevent="save">
									<div class="col-12">
										<label for="inputcategoryname" class="form-label">Category Name</label>
										<input type="text" class="form-control" id="inputcategoryname" v-model="form.category_name">
								
									</div>

									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5" >Submit</button>
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
				category_name:""	
			}
	
		}
		

	},
	
	methods: {
        save(){
						
		    axios.post('/api/category',this.form)
			.then(()=>{
			
			 this.$router.push({name:'category'})
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