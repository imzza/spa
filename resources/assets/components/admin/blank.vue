<template>
    <div>
        <div class="contact-page">
        <div class="container-fluid bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="p-5">
                        <h4>
                            <span>
                                <i class="fa fa-address-book-o"></i> Contacts
                            </span>
                            <span class="float-right">
                                <input type="search"  placeholder="Search here" class="search form-control pl-2 pr-2">
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-white mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <div class="box-shadow mt-4">
                               <div class="border-bottom border-secondary p-3">
                                   <img src="~img/authors/avatar1.jpg" alt="user profile" class="contact-profile d-inline-block rounded-circle">
                                   <p class="d-inline-block">&nbsp;&nbsp;Jon Doe</p>
                               </div>
                                <div class="options border-bottom border-secondary">
                                    <a href="#" class="p-3 d-block text-dark">Contacts</a>
                                    <a href="#" class="p-3 d-block text-dark">Frequently contacted </a>
                                    <a href="#" class="p-3 d-block text-dark">Starred Contacts</a>
                                </div>
                                <div class="options2">
                                    <a href="#" class="p-3 d-block text-dark">Groups</a>
                                    <a href="#" class="p-3 d-block text-dark">Friends</a>
                                    <a href="#" class="p-3 d-block text-dark">Clients</a>
                                    <a href="#" class="p-3 d-block text-dark">Recent Workers</a>
                                    <a href="#" class="p-3 d-block text-dark">New Group</a>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" @click="modalShow = !modalShow" >Add New Contact</button>
                            <b-modal v-model="modalShow" :hide-footer="true" title="Add your contact here">
                                <b-container fluid>
                                    <form>
                                        <input type="text" class="form-control mt-3" placeholder="Enter name" v-model="newname">
                                        <input type="file" class="btn btn-primary mt-3" >
                                        <input type="text" class="form-control mt-3" placeholder="Enter phone number" v-model="newnumber">
                                        <input type="email" class="form-control mt-3" placeholder="Enter email" v-model="newemail">
                                        <input type="text" class="form-control mt-3" placeholder="Enter role" v-model="newrole">
                                        <input type="text" class="form-control mt-3 mb-3" placeholder="Location" v-model="newlocation">
                                        <b-btn  class="float-right" variant="primary" @click="addContact">
                                            Submit
                                        </b-btn>
                                    </form>
                                </b-container>
                            </b-modal>
                        </div>
                        <div class="col-10">
                            <div class="box-shadow mt-4">
                                <div class="contacts-box">
                                    <div class="total-contacts p-5 ">
                                        <span>All Contacts(25)</span>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <tr v-for="(contact, index) in contacts">
                                                <td>
                                                    <b-form-checkbox></b-form-checkbox>
                                                </td>
                                                <td>{{contact.name}}</td>
                                                <td><img :src="contact.img" alt="profile" class="contact-pic rounded-circle"></td>
                                                <td>{{contact.email}}</td>
                                                <td>{{contact.contact}}</td>
                                                <td>{{contact.role}}</td>
                                                <td>{{contact.location}}</td>
                                                <td><span class="fa fa-edit"></span></td>
                                                <td><span class="fa fa-trash-o"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="todo mt-5">
            <div class="todoside-menu">
                <div class="row">
                    <div class="col-3">
                        <div class="side-content ">
                            <div class="box-shadow">
                                <h1 class="p-3 mb-4">Todo's</h1>
                                <div class="p-3">
                                    <button class="btn btn-primary btn-block" @click="modalTask = !modalTask" >Add Task</button>
                                </div>
                                <b-modal v-model="modalTask" :hide-footer="true" title="Add Your Task Here">
                                    <b-container fluid>
                                        <form>
                                            <label for="tasktitle" class="mt-2">Task Title</label>
                                            <input type="text" id="tasktitle" class="form-control" placeholder="Enter Title" v-model="newtaskname">
                                            <label for="taskdesc" class="mt-2">Task Description</label>
                                            <textarea name="description" placeholder="Add description here" class="form-control" rows="5" id="taskdesc" v-model="newtaskdesc"></textarea>
                                            <label for="deadline" class="mt-2">Deadline</label>
                                            <input type="date" class="form-control" placeholder="Deadline" id="deadline" v-model="newtaskdeadline">
                                            <label><b-form-checkbox class="mt-2" v-model="newimportant"></b-form-checkbox> Click if this a important task</label>
                                            <b-btn  class="float-right mt-2" variant="primary" @click="addTask">
                                                Submit
                                            </b-btn>
                                        </form>
                                    </b-container>
                                </b-modal>
                                <a href="#" class="alltasks border-bottom border-secondary d-block p-3"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; All Tasks</a>
                                <a href="#" class="today d-block p-3"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp;Today's Tasks (10)</a>
                                <a href="#" class="needaction d-block p-3"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;Action Needed Taks (25)</a>
                                <a href="#" class="important d-block p-3"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp;Important Tasks (13)</a>
                                <a href="#" class="pending d-block p-3"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Pending Taks (54)</a>
                                <a href="#" class="deleted d-block p-3"><i class="fa fa-trash-o" aria-hidden="true"></i> &nbsp;Deleted Tasks</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tasksearch p-3">
                            <input type="text" class="form-control mt-4 mb-4" placeholder="Search">
                        </div>
                        <div class="tasks-list mt-5">
                            <div class="task-type p-3">
                                <h3>All Tasks</h3>
                            </div>
                            <table class="table">
                                <tr v-for="(task, index) in tasks">
                                    <td><span class="fa fa-plus"></span></td>
                                    <td>
                                        <b-form-checkbox></b-form-checkbox>
                                    </td>
                                    <td>
                                        <h3>{{task.tasktitle}} <i class="fa text-danger" v-bind:class="{faExclamationCircle: task.important==true}"></i></h3>
                                        <p>{{task.taskdescription}}</p>
                                        <span class="text-danger">Deadline:</span> {{task.taskdeadline}}
                                    </td>
                                    <td><span class="fa fa-edit"></span></td>
                                    <td><span class="fa fa-trash-o"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        // ===Component name
        name: "blank",
        // ===Props passed to component
        props: {},
        // ===Components used by this component
        components: {

        },
        // ===component Data properties
        data() {
            return {
                modalShow: false,
                newname:'',
                newemail:'',
                newnumber:'',
                newlocation:'',
                newrole:'',
                contacts:[{
                    name:'Jon',
                    img:require('../../assets/img/authors/avatar1.jpg'),
                    email:'jon@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },{
                    name:'Doe',
                    img:require('../../assets/img/authors/avatar2.jpg'),
                    email:'doe@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },{
                    name:'Addison',
                    img:require('../../assets/img/authors/avatar3.jpg'),
                    email:'addison@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },{
                    name:'Jon',
                    img:require('../../assets/img/authors/avatar4.jpg'),
                    email:'jon@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },{
                    name:'Doe',
                    img:require('../../assets/img/authors/avatar1.jpg'),
                    email:'jon@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },{
                    name:'Jon',
                    img:require('../../assets/img/authors/avatar.jpg'),
                    email:'jon@gmail.com',
                    contact:'0123456789',
                    role:'Web developer',
                    location:'Hyderabad'
                },],


                //                this is tasks page data
                modalTask:false,
                newtaskname:'',
                newtaskdesc:'',
                newtaskdeadline:'',
                newimportant:'',
                tasks:[{
                    tasktitle:'Task-1',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:true,
                },{
                    tasktitle:'Task-2',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:true,
                },{
                    tasktitle:'Task-3',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:'true',
                },{
                    tasktitle:'Task-4',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:'true',
                },{
                    tasktitle:'Task-5',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:'true',
                },{
                    tasktitle:'Task-6',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:'true',
                },{
                    tasktitle:'Task-7',
                    taskdescription:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, hic quasi! Doloribus esse magni necessitatibus officia recusandae. Aliquam, aspernatur commodi, debitis harum illum odio porro quasi quia repudiandae ullam ut?',
                    taskdeadline:'14/04/2018',
                    important:'true',
                },]
            }
        },
        // ===Code to be executed when Component is mounted
        mounted() {

        },
        // ===Computed properties for the component
        computed: {

        },
        // ===Component methods
        methods: {
            addContact:function(){
                this.contacts.push({
                    name:this.newname,
                    email:this.newemail,
                    number:this.newnumber,
                    location:this.newlocation,
                    role:this.newrole
                }),
                this.modalShow=false
            },


            //            task section

            addTask:function () {
                this.tasks.push({
                    tasktitle:this.newtaskname,
                    taskdescription:this.newtaskdesc,
                    taskdeadline:this.newtaskdeadline,
                    important:this.newimportant,
                }),
                    this.newtaskname='',
                    this.newtaskdesc='',
                    this.newtaskdeadline='',
                    this.newimportant=false,
                    this.modalTask=false
            }

        }

    }
</script>
<!-- styles -->
<!-- adding scoped attribute will apply the css to this component only -->
<style scoped>
    .search{
        border: 1px solid #bdb3b3;
    }
    .contact-profile{
        width:50px;
        height: 50px;
    }
    .box-shadow{
        box-shadow: 0px 0px 1px 1px #cfcfcf;
    }
    .contact-pic{
        width: 50px;
        height: 50px;
    }
    .table td{
        padding: 16px;
        vertical-align: middle;
    }
    .contacts-box .custom-control-inline{
        margin-right: 0;
    }
    .custom-control-label::before{
        width: 100px;
        height: 100px;
    }
    .contact-page{
        font-size: 14px;
    }
    .options a:hover,.options2 a:hover{
        background-color: #eee;
    }


    /* to do list */
    .todoside-menu a:hover{
        background-color: #f5f5f5;
    }
    .todoside-menu a{
        font-size: 15px;
        color: #333;
    }
    .faExclamationCircle::before{
        content: "\f06a";
        font-size: 14px;
        top:-10px;
        position: relative;
    }
    .tasksearch,.tasks-list{
        box-shadow:0px 0px 1px 1px #cfcfcf;
    }
    .todo{
        padding: 15px;
        background-color: #fff;
    }
</style>