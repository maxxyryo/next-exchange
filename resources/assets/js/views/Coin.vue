<template>
  <div class="animated fadeIn">
    <div class="card">
		<div class="card-header">
        Coin
		</div>
		<div class="alert alert-success" v-if="success==true">
		<strong>{{message}}!</strong> 
		</div>
		<div class="card-body">
			<droply id="myDroply"
				ref="droplyOne"
				url="/Storeimage"
				upload-message-text="Drop file(s) to upload <br><strong>or click</strong>"
				@droply-file-added="onFileAdded"
				@droply-removed-file="onFileRemoved"
				@droply-success="onSuccess">
			</droply>
			<br>
			<span class="alert alert-danger">Please Upload Only jpg image and Coin title will be image Name</span>
			<br>
			<button v-if="showRemoveAllButton" class="btn btn-primary" @click="removeAll()">Remove all</button>
			<br>
			<br>
			 <div class="error" v-if="errorflag=true">
				<ul id="">
					<li v-for="msg in fileerror">{{ msg }}</li>
				</ul>
			 </div>
		</div>
		<div class="card-body"> 
			<form role="form" v-on:submit.prevent=Savedetails()>
				<div class="form-group">
					<label>Coin Name</label>
					<input type="text"  name="coinname"  class="form-control" v-model="data.coinname"  placeholder="Enter Coin Name" />
					<span v-if="formErrors.coinname" class="error text-danger">{{formErrors.coinname[0] }}</span>
						 
				</div>
				<div class="form-group">
					<label>Coin Description</label>
					<input type="text" v-model="data.description" class="form-control" placeholder="description" />
					<span v-if="formErrors.description" class="error text-danger">{{formErrors.description[0] }}</span>
				</div>
				<div class="form-group">
					<label>Coin Title</label>
					<input type="text" v-model="data.title" class="form-control" placeholder="title" />
					<span v-if="formErrors.title" class="error text-danger">{{formErrors.title[0]}}</span>
				</div>
				<div class="form-group">
					<label>Coin market</label>
					<input type="text" v-model="data.market" class="form-control" placeholder="market" />
					 <span v-if="formErrors.market" class="error text-danger">{{formErrors.market[0] }}</span>
				</div>
				<button type="submit"  class="btn btn-green">Submit</button>
			</form>
			 <br>

			<br>
		</div>
	</div>
  </div>
</template>
<script>
import Droply from 'droply'
import { Validator } from 'vee-validate'
export default {
  name: 'markets',
   components: {
        Droply
    },
   data() {
            return{
                processQueue: false,
                showRemoveAllButton: false,
                fileerror: {},
                error:'',
                message:'',
                success:'false',
                errorflag: false,
                filename:'',
                error:null,
                response:'',
                data:{
					coinname:'',
					market:'',
					title:'',
					description:'',
					filedata:''
                },
                formErrors:{},               
            }
        },
        mounted ()
        {
			let self=this;
			 socket.on("test-channel:App\\Events\\Coinupdate", function(message){
			  console.log('component running');
			  console.log(message);
            
        });
        },
        methods:{
			Savedetails(){
			this.formErrors={};
             var url ='/SaveCoindetails';
					this.$http.post(url,this.data,).then(response => {
					this.errors = [];
					 if(response.body.success == 0)
					   {
						   this.formErrors = response.body.data
					   }
					   else{
							   this.message = 'Coin has been Added.'; 
							   this.success=true;
					   }
				  
						this.data = {
						coinname:'',
						market:'',
						title:'',
						description:''
						}
					
				   });
		
			},
			onFileAdded() {
				this.showRemoveAllButton = true
			},
			onFileRemoved() {
				this.showRemoveAllButton = false
			},
			onSuccess(file) {
				this.data = JSON.parse(file.xhr.response);
					if (this.data.status == 0) {
						this.fileerror = this.data.data.file;
						this.errorflag = true;
						this.removeAll();
					}
					else {
						this.data = JSON.parse(file.xhr.response);
						this.filename=this.data.data;
						this.message = 'logo upload Successfully.'; 
						this.fileerror = {};
						this.errorflag = true;
						this.success=true;
					}
			},
			removeAll() {
				this.$refs.droplyOne.removeAllFiles()
			}
         
        }
}
 </script>  
