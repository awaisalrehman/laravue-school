<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-primary">Add Student</a>
      </div>
    </div>

    <div class="row justify-content-center">
      <div v-bind:class="{ succmsg: succmsg }">
        <div class="col-md-12 col-lg-12">
          <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
        </div>
      </div>
      <div class="col-md-12">
        <!-- Button trigger modal -->

        <!-- Modal -->

        <div class="modal fade"
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" name="addstudent" id="addstudent" action="#" @submit.prevent="addStudent">
                  <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="student.name" />
                  </div>
                  <div class="form-group">
                    <label for="father_name">Father Name</label>
                    <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father Name" v-model="student.father_name"
                    />
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" v-model="student.gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Roll#</label>
                    <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.roll_no" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact" v-model="student.contact" />
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" v-model="student.address" />
                  </div>

                  <!-- <div class="form-group">
                  <label for="post_content">Body</label>
                  <textarea name="post_content" id="post_content" class="form-control" placeholder="Post Body" v-model="post.post_content"></textarea>
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="email" v-model="post.email" />
              </div> -->

                  <div class="form-group text-right">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade"
             id="exampleModal1"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form method="post" name="updatestudent" id="updatestudent" action="#" @submit.prevent="updateStudent">
                  <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="student.name" />
                  </div>
                  <div class="form-group">
                    <label for="father_name">Father Name</label>
                    <input type="text"
                           name="father_name"
                           id="father_name"
                           class="form-control"
                           placeholder="Father Name"
                           v-model="student.father_name" />
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" v-model="student.gender">
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                          <option value="3">Other</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="roll_no">Roll#</label>
                    <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Roll Number" v-model="student.roll_no" />
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact" v-model="student.contact" />
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" v-model="student.address" />
                  </div>

                  <!-- <div class="form-group">
                        <label for="post_content">Body</label>
                        <textarea name="post_content" id="post_content" class="form-control" placeholder="Post Body" v-model="post.post_content"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email" v-model="post.email" />
                      </div> -->

                  <div class="form-group text-right">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <p>Are you sure want to delete the record? </p>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-success" v-on:click="hideModal()">Cancel</button>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-success" v-on:click="deleteStudent()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Students List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Roll#</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Gender</th>
                  <th>Contact</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in laravelData.data" :key="student.id">
                  <th scope="row">{{ student.roll_no }}</th>
                  <td>{{ student.name }}</td>
                  <td>{{ student.father_name.slice(0,50) + "....." }}</td>
                  <td>{{ student.gender }}</td>
                  <td>{{ student.contact }}</td>
                  <td><a href="#"
                       v-on:click="editStudent(student.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="student.name">Edit</a></td>
                  <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(student.id)" data-toggle="modal" v-bind:id="id">Delete</a></td>
                </tr>
              </tbody>
              </tbody>
            </table>
            <pagination :data="laravelData" :limit="2" @pagination-change-page="studentLists">
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>

  export default {
    data() {
      return {
        student: {
          name: '',
          father_name: '',
          roll_no: '',
          gender: '',
          contact: '',
          address: ''
        },
        laravelData: {},
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    methods: {
      studentLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/students?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })
      },
      addStudent() {
        this.$http
          .post('http://127.0.0.1:8000/api/students', {
            name: this.student.name,
            father_name: this.student.father_name,
            gender: this.student.gender,
            contact: this.student.contact,
            roll_no: this.student.roll_no,
            address: this.student.address
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.student.name = ''
            this.student.father_name = ''
            this.student.gender = ''
            this.student.roll_no = ''
            this.student.contact = ''
            this.student.address = ''
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Data inserted successfully'
            $('#exampleModal').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.studentLists(this.pagenumber)
          })
      },
      editStudent(studentid) {
        this.$http.get('http://127.0.0.1:8000/api/students/' + studentid).then(data => {
          this.student.name = data.data.data.name
          this.student.father_name = data.data.data.father_name
          this.student.gender = data.data.data.gender
          this.student.roll_no = data.data.data.roll_no
          this.student.contact = data.data.data.contact
          this.student.address = data.data.data.address
          this.id = studentid
        })
      },
      updateStudent() {
        this.$http
          .patch('http://127.0.0.1:8000/api/students/' + this.id, {
            name: this.student.name,
            father_name: this.student.father_name,
            gender: this.student.gender,
            contact: this.student.contact,
            roll_no: this.student.roll_no,
            address: this.student.address
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.student.name = ''
            this.student.father_name = ''
            this.student.gender = ''
            this.student.roll_no = ''
            this.student.contact = ''
            this.student.address = ''
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Data updated successfully'
            $('#exampleModal1').modal('hide')
            $('body')
              .removeClass()
              .removeAttr('style')
            $('.modal-backdrop').remove()
            this.studentLists(this.pagenumber)
          })
      },
      deleteId(studentid) {
        this.id = studentid
      },
      deleteStudent() {
        this.$http.delete('http://127.0.0.1:8000/api/students/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Data deleted successfully'
          this.studentLists(this.pagenumber)
          $('#exampleModal2').modal('hide')
          $('body')
            .removeClass()
            .removeAttr('style')
          $('.modal-backdrop').remove()
        })
      },
      hideModal() {
        $('#exampleModal2').modal('hide')
        $('body')
          .removeClass()
          .removeAttr('style')
        $('.modal-backdrop').remove()
      }
    },
    mounted() {
      this.studentLists()
    }
  }

</script>

<style scoped>

  .succmsg {
    display: none;
  }
  .showmodal {
    display: none !important;
    opacity: 0;
  }

</style>
