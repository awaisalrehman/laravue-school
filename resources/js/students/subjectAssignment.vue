<template>

  <div id="postsrec" class="mt-5">

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
             id="exampleModal1"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
              </div>
              <div class="modal-body">
                <form v-if="this.unassignedSubjects.length > 0" method="post" name="assignsubjects" id="assignsubjects" action="#" @submit.prevent="assignSubject(student_id, subject_id)">

                  <div class="form-group">
                    <label for="gender">Unassigned Subjects</label>
                    <select class="form-control" name="subject" id="subject" v-model="subject_id">
                          <option v-for="subject in unassignedSubjects"  :key="subject.id" v-bind:value="subject.id">{{ subject.name }}</option>
                    </select>
                  </div>

                  <div class="form-group text-center">
                    <button class="btn btn-success">Submit</button>
                  </div>
                </form>
                <span v-else>All Subjects Assigned to this Student!</span>
                <br/>

                <span class="mt-3">Assigned Subjects</span>
                <table class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Subjects</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="subject in assignedSubjects" :key="subject.id">
                      <th scope="row">{{ subject.name }}</th>
                      <td><a href="#" data-target="#exampleModal2" v-on:click="deleteSubject(student_id, subject.id)" data-toggle="modal">Delete</a></td>
                    </tr>
                  </tbody>
                  </tbody>
                </table>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in students.data" :key="student.id">
                  <th scope="row">{{ student.roll_no }}</th>
                  <td>{{ student.name }}</td>
                  <td>{{ student.father_name.slice(0,50) + "....." }}</td>
                  <td>{{ student.gender }}</td>
                  <td>{{ student.contact }}</td>
                  <td><a href="#"
                       v-on:click="unassignedSubjectsList(student.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="student.name">Assign Subjects</a></td>
                </tr>
              </tbody>
              </tbody>
            </table>
            <pagination :data="students" :limit="2" @pagination-change-page="studentLists">
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
        students: {},
        assignedSubjects: [],
        unassignedSubjects: [],
        student_id: '',
        subject_id: '',
        id: '',
        succmsg: true,
        showmodal: false,
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
          this.students = response.data
          this.pagenumber = page
        })
      },
      unassignedSubjectsList(student) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/unassignedsubjects').then(response => {
          this.unassignedSubjects = response.data;
          this.student_id = student;
          this.assignedSubjectsList(student);
        })
      },
      assignedSubjectsList(student) {
        this.$http.get('http://127.0.0.1:8000/api/students/'+student+'/assignedsubjects').then(response => {
          this.assignedSubjects = response.data
        })
      },
      assignSubject(student_id, subject_id) {
        this.$http
          .post('http://127.0.0.1:8000/api/students/'+student_id+'/assignsubject/'+subject_id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
          })
          .then(data => {
            this.subject_id = '';
            this.assignedSubjectsList(student_id);
            this.unassignedSubjectsList(student_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
          })
      },
      deleteSubject(student_id, subject_id) {
        this.$http
          .delete('http://127.0.0.1:8000/api/students/'+student_id+'/deletesubject/'+subject_id, {
            student_id: this.student_id,
            subject_id: this.subject_id,
          })
          .then(data => {
            this.subject_id = '';
            this.assignedSubjectsList(student_id);
            this.unassignedSubjectsList(student_id);
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
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
