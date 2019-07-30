<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style type="text/css">
            .error{ color: #d43f3a; }
            /*vue js modal css start*/
            .modal-mask {position: fixed;z-index: 9998;top: 0;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, .5);display: table;transition: opacity .3s ease;}
            .modal-wrapper { display: table-cell;vertical-align: middle;}
            .modal-container { width: 600px;margin: 0px auto;padding: 20px 30px;background-color: #fff;border-radius: 2px;
              box-shadow: 0 2px 8px rgba(0, 0, 0, .33);transition: all .3s ease;font-family: Helvetica, Arial, sans-serif;}
            .modal-header h3 {margin-top: 0;color: #42b983;}
            .modal-body {margin: 20px 0;}
            .modal-default-button {float: right;}
            /*
             * The following styles are auto-applied to elements with
             * transition="modal" when their visibility is toggled
             * by Vue.js.
             *
             * You can easily play with the modal transition by editing
             * these styles.
             */
            .modal-enter {opacity: 0;}
            .modal-leave-active {opacity: 0;}
            .modal-enter .modal-container,
            .modal-leave-active .modal-container {-webkit-transform: scale(1.1);transform: scale(1.1);}
            /*vue js modal css end*/
        </style>
    </head>
    <body>
        <br>
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required="required" v-model="newItem.name">
                            <span class="error" v-bind:class="{hidden: hasError}">Please Enter Name</span>
                        </div>
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email ID" required="required" v-model="newItem.email">
                            <span class="error" v-bind:class="{hidden: hasError}">Please Enter Email ID</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right" @click.prevent="createItem()">Save</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items">
                                    <td>@{{item.id}}</td>
                                    <td>@{{item.name}}</td>
                                    <td>@{{item.email}}</td>
                                    <td>@{{item.created_at}}</td>
                                    <td>
                                        <a href="" id="show-modal" @click.prevent="showModal = true; setVal(item.id, item.name, item.email)" class="btn btn-default">Edit</a>
                                        <a href="" @click.prevent="deleteItem(item)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <modal v-if="showModal" @close="showModal = false">
                            <h3 slot="header">Edit Item</h3>
                            <div slot="body">
                                <input type="hidden" name="e_id" id="e_id" disabled :value="this.e_id">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="e_name" id="e_name" class="form-control" placeholder="Enter Name" required="required" :value="this.e_name">
                                </div>
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <input type="text" name="e_email" id="e_email" class="form-control" placeholder="Enter Email ID" required="required" :value="this.e_email">
                                </div>
                            </div>
                            <div slot="footer">
                                <button class="btn btn-default" @click="showModal = false">Cancel</button>
                                <button class="btn btn-primary" @click="editItem()">Update</button>
                            </div>
                        </modal>
                    </div>                    
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
        <!-- template for the modal component -->
        <script type="text/x-template" id="modal-template">
          <transition name="modal">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-container">

                  <div class="modal-header">
                    <slot name="header">
                      default header
                    </slot>
                  </div>

                  <div class="modal-body">
                    <slot name="body">
                      default body
                    </slot>
                  </div>

                  <div class="modal-footer">
                    <slot name="footer">
                      default footer
                    </slot>
                  </div>
                </div>
              </div>
            </div>
          </transition>
        </script>
    </body>
</html>
