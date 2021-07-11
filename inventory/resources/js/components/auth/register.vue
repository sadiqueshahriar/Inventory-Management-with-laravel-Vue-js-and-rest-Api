
<template>
    <div>
        	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">

						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign Up</h3>
										<p>Already have an account? <router-link to="/">Sign in here</router-link>
										</p>
									</div>
									<div class="d-grid">
										<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="backend/assets/images/icons/search.svg" width="16" alt="Image Description">
                          <span>Sign Up with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
										<hr/>
									</div>
									<div class="form-body">
										<form class="row g-3 user" @submit.prevent="signup">
											<div class="col-sm-12">
												<label for="inputFirstName" class="form-label">User Name</label>
												<input type="text" class="form-control"  placeholder="" v-model="form.name">
											</div>

											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input type="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com" v-model="form.email">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="inputChoosePassword"  placeholder="Enter Password" v-model="form.password" required>
												
													 <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>																																
												</div>
	
											</div>	
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Confirm Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="inputChoosePassword"  placeholder="Enter Password" v-model="form.confirm_password" required>
												
													 <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>																																
												</div>
		
											
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
    </div>
</template>


<script>
export default{
	created(){
		if(User.loggedIn()){
			this.$router.push({name:'home'})
		}
	},
	data(){
		return{
			form:{
				name:null,
				email:null,
				password:null,
				confirm_password:null
			},
			errors:{
			}
	
		}

	},
	methods: {
		signup(){
			axios.post('api/auth/signup',this.form)
			.then(res=>{
			User.responseAfterLogin(res)
				Toast.fire({
				icon: 'success',
				title: 'Signed in successfully'
				})
			this.$router.push({name:'home'})			
			})
			.catch(function (error) { console.log(error.response.data.errors); });


		}
	}


}

</script>

<style>
    
</style>
