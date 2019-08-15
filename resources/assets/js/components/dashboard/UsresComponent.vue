<template>
    <div class="row mt-5">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Users Table</h3>

            <div class="card-tools">
                <button class="btn btn-success" data-toggle="modal" @click="newModal">
                    <i class="fa fa-user-plus"></i> Add New User
                </button>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Registered At</th>
                    <th>Modify</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key = "user.id">
                    <td>{{user.id}}</td>
                    <td>{{ user.name | capitalize }}</td>
                    <td>{{ user.email }}</td>
                    <td> {{ user.type | capitalize }} </td>
                    <td> {{ user.created_at | ago }} </td>
                    <td>
                        <a href="#" @click="editModal(user)"><i class="fa fa-edit fa-sm"></i></a>
                        <a href="#" @click="deleteUser(user.id)"><i class="fa fa-trash fa-sm"></i></a>
                    </td>
                </tr>

                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>



          <!-- Modal to add new user -->
        <div class="modal fade" id="newModel" tabindex="-1" role="dialog" aria-labelledby="addNewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewUserTitle">{{ editmodal ? "Update User" : "Add New User" }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmodal ? updateUser() : createUser()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                    <label>Name</label>
                    <input v-model="form.name" type="text" name="name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">
                    <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Email</label>
                    <input v-model="form.email" type="email" name="email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
                    <has-error :form="form" field="email"></has-error>
                    </div>

                    <div v-show="!editmodal" class="form-group">
                    <label>Password</label>
                    <input v-model="form.password" type="password" name="password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="password">
                    <has-error :form="form" field="password"></has-error>
                    </div>
                    <div v-show="editmodal" class="form-group">
                    <label>New Password</label>
                    <input v-model="form.password" type="password" name="new_password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="password">
                    <has-error :form="form" field="password"></has-error>
                    </div>
                    <div v-show="editmodal" class="form-group">
                    <label>Confirmation Password</label>
                    <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="password">
                    <has-error :form="form" field="password"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Bio</label>
                    <input v-model="form.bio" type="text" name="bio"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" placeholder="Bio">
                    <has-error :form="form" field="bio"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Type</label>
                    <select name="type" id="type" v-model="form.type"  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                        <option value="">Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="geust">Geust</option>

                    </select>
                    <has-error :form="form" field="type"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <!-- <div class="form-group">
                        <label>Upload Photo</label>
                        <input type="file" name="photo"
                            class="form-control-file" :class="{ 'is-invalid': form.errors.has('photo') }">
                        <has-error :form="form" field="photo"></has-error>
                    </div> -->
                    <!-- <button :disabled="form.busy" type="submit" class="btn btn-primary">Log In</button> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-show="editmodal" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmodal" type="submit" class="btn btn-primary">Save</button>
                    <!-- <button type="submit" class="btn btn-primary">{{ editmodal ? "Update" : "Save" }}</button> -->
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>


</template>

<script>

    export default {

        data () {
            return {
                editmodal:false,
                users:[],
            // Create a new form instance
            form: new Form({
                id:'',
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',

                remember: false
            })
            }
        },
        methods: {
            updateUser(id){
                this.$Progress.start();
            // Submit the form via a POST request
                this.form.put('api/user/'+this.form.id)
                    .then(()=>{
                        $("#newModel").modal('hide')
                        Fire.$emit('AfterCreate');
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'User Update Successfuly',
                            showConfirmButton: false,
                            timer: 1500
                            });
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                    })
            },
            editModal(user){
                this.form.reset();
                $('#newModel').modal('show');
                this.form.fill(user);
                this.editmodal = true;
            },

            newModal(){
                this.form.reset();
                $('#newModel').modal('show');
            },
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if(result.value){
                            this.form.delete('api/user/'+id).then(()=>{
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                Fire.$emit("AfterCreate");
                            }).catch(()=>{
                                Swal("Failed","There are something worong","Warning");
                            });
                        }


                    })
            },
            createUser () {
                this.$Progress.start();
            // Submit the form via a POST request
                this.form.post('api/user')
                    .then(()=>{
                        $("#addNewUser").modal('hide')
                        Fire.$emit('AfterCreate');
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'User Created Successfuly',
                            showConfirmButton: false,
                            timer: 1500
                            });
                        this.$Progress.finish();
                    })
                    .catch(()=>{

                    })



            },
            loadUser(){
                axios.get('api/user')
                    .then(({data}) => this.users = data.data);
            }
        },
        created() {
            this.loadUser();
            Fire.$on('AfterCreate',()=>{
                this.loadUser();
            });
            // setInterval(()=>this.loadUser(),3000)
        },

    }
</script>
