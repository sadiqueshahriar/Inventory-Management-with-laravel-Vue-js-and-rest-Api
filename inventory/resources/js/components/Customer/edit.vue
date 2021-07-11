<template>
 <div>
 				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
                 <router-link to="/customer" class="btn btn-primary button">All Customer</router-link>
						</div>

					</div>
				</div>

    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Customer Information</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Customer Update</h5>
								</div>
								<hr>
								<form class="row g-3" enctype="multipart/form-data" @submit.prevent="customerUpdate">
                                    <div class="col-md-6">
										<label for="inputFirstName" class="form-label">Name</label>
										<input type="text" class="form-control" id="inputFirstName" v-model="form.name">
									</div>

									<div class="col-md-6">
										<label for="inputEmail" class="form-label">Email</label>
										<input type="email" class="form-control" id="inputEmail" v-model="form.email">
										
									</div>

 									<div class="col-md-6">
										<label for="inputSalary" class="form-label">Phone</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.phone">
									</div>                                                                     
									<div class="col-md-6">
										<label for="inputAddress" class="form-label">Address</label>
										<textarea class="form-control" id="inputAddress" placeholder="Address..." rows="2" v-model="form.address"></textarea>
                                    </div>
 									<div class="col-12">	
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="formFile" @change="fileSlected">		
									</div>                                   
 									<div class="col-12">	
                                         <img :src="form.photo" style="height:40px; width:40px">
									</div>
										<!-- <span v-if="!$v.photo.required" class="text-danger">Image is required</span>									  -->

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
                name:"",			
				email:"",
				address:"",
				phone:"",
				photo:"",
                newPhoto:""
			}
	
		}
		

	},
    created(){
        let id=this.$route.params.id
        axios.get('/api/customer/'+id)
        .then(({data})=>(this.form=data))
        .catch(console.log('error'))
    },	
	methods: {
        fileSlected(event){
            let file=event.target.files[0];
            if(file.size>1048770){
                Notification.imageValidation()
            }
            else{
                let reader=new FileReader();
                reader.onload=event=>{
                    this.form.newPhoto=event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        customerUpdate(){
			 let id=this.$route.params.id			
		    axios.patch('/api/customer/'+id,this.form)
			.then(()=>{
			
			 this.$router.push({name:'customer'})
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