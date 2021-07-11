<template>
 <div>
 				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
                 <router-link to="/product" class="btn btn-primary button">All Product</router-link>
						</div>

					</div>
				</div>

    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Product Information</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Product Update</h5>
								</div>
								<hr>
								<form class="row g-3" enctype="multipart/form-data" @submit.prevent="productUpdate">
<div class="col-md-6">
										<label for="inputFirstName" class="form-label">Product Name</label>
										<input type="text" class="form-control" id="inputFirstName" v-model="form.product_name">
									</div>
									<div class="col-md-6">
										<label for="inputLastName" class="form-label">Product Code</label>
										<input type="text" class="form-control" id="inputLastName" v-model="form.product_code ">
									</div>
									<div class="col-md-6">
                                        <label class="form-label">Product Category</label>
										<select class="single-select form-control" v-model="form.category_id">
								<option :value="category.id" v-for="category in categories" :key="category.id">{{ category.category_name }}</option>
	
                                    	</select>									
									
									</div>
									<div class="col-md-6">
                                       <label class="form-label">Product Supplier</label>
										<select class="single-select form-control" v-model="form.supplier_id ">
										<option :value="supplier.id" v-for="supplier in Suppliers" :key="supplier.id">{{ supplier.name }}</option>

                                    	</select>											
									</div>
 									<div class="col-md-4">
										<label for="inputSalary" class="form-label">Product Root</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.root ">										
									</div> 
    								<div class="col-md-4">
										<label for="inputSalary" class="form-label">Buying Price</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.buying_price ">	
									</div> 
                        			<div class="col-md-4">
										<label for="inputSalary" class="form-label">Selling Price</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.selling_price ">	
									</div> 

 									<div class="col-md-6">
										<label for="inputSalary" class="form-label">Buying Date</label>
										<input type="date" class="form-control" id="inputSalary" v-model="form.buying_date">

                                     </div>
                                		<div class="col-md-6">
										<label for="inputSalary" class="form-label">Product Quantity</label>
										<input type="text" class="form-control" id="inputSalary" v-model="form.product_quantity">
                                     </div>

 									<div class="col-12">	
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="formFile" @change="fileSlected">		
									</div>                                   
 									<div class="col-12">	
                                         <img :src="form.image" style="height:40px; width:40px">
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
				category_id :"",
				product_name :"",
				product_code:"",
				root :"",
				buying_price:"",
				selling_price:"",
				supplier_id:"",
				buying_date:"",
				image:"",
				product_quantity:"",
                newPhoto:""
			},
            categories:[],
            Suppliers:[]
	
		}
		

	},
    created(){
        let id=this.$route.params.id
        axios.get('/api/product/'+id)
        .then(({data})=>(this.form=data))
        .catch(console.log('error'))

         axios.get('/api/category')
			 .then(({data})=>(this.categories=data))		
			.catch()

        axios.get('/api/supplier')
			 .then(({data})=>(this.Suppliers=data))		
			 .catch()
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
        productUpdate(){
			 let id=this.$route.params.id			
		    axios.patch('/api/product/'+id,this.form)
			.then(()=>{
			
			 this.$router.push({name:'product'})
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