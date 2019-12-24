<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-primary">Add Subject</a>
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
                <form method="post" name="addsubject" id="addsubject" action="#" @submit.prevent="addSubject">
                  <div class="form-group">
                    <label for="name">Subject Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="subject.name" />
                  </div>

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
                <form method="post" name="updatesubject" id="updatesubject" action="#" @submit.prevent="updateSubject">
                  <div class="form-group">
                    <label for="name">Subject Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="subject.name" />
                  </div>

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
                  <button class="btn btn-success" v-on:click="deleteSubject()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Subjects List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Subject Name</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="subject in laravelData.data" :key="subject.id">
                  <td>{{ subject.name }}</td>
                  <td><a href="#"
                       v-on:click="editSubject(subject.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="subject.name">Edit</a></td>
                  <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(subject.id)" data-toggle="modal" v-bind:id="id">Delete</a></td>
                </tr>
              </tbody>
              </tbody>
            </table>
            <pagination :data="laravelData" :limit="2" @pagination-change-page="subjectLists">
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
        subject: {
          name: ''
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
      subjectLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/subjects?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })
      },
      addSubject() {
        this.$http
          .post('http://127.0.0.1:8000/api/subjects', {
            name: this.subject.name
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.subject.name = ''
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
            this.subjectLists(this.pagenumber)
          })
      },
      editSubject(subjectid) {
        this.$http.get('http://127.0.0.1:8000/api/subjects/' + subjectid).then(data => {
          this.subject.name = data.data.data.name
          this.id = subjectid
        })
      },
      updateSubject() {
        this.$http
          .patch('http://127.0.0.1:8000/api/subjects/' + this.id, {
            name: this.subject.name
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.subject.name = ''
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
            this.subjectLists(this.pagenumber)
          })
      },
      deleteId(subjectid) {
        this.id = subjectid
      },
      deleteSubject() {
        this.$http.delete('http://127.0.0.1:8000/api/subjects/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Data deleted successfully'
          this.subjectLists(this.pagenumber)
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
      this.subjectLists()
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
