<template>

  <div id="postsrec" class="mt-5">

    <div class="row mt-5">
      <div class="col-lg-12 text-right" style="margin-bottom: 20px;">
        <a href="#"
           data-target="#exampleModal"
           data-toggle="modal"
           class="btn btn-primary">Add GradeSetting</a>
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
                <form method="post" name="addstudent" id="addstudent" action="#" @submit.prevent="addGradeSetting">
                  <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input type="text" name="percentage" id="percentage" class="form-control" placeholder="percentage" v-model="setting.percentage"
                    />
                  </div>
                  <div class="form-group">
                    <label for="grade">Grade</label>
                    <input type="text" name="grade" id="grade" class="form-control" placeholder="Grade" v-model="setting.grade" />
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description" v-model="setting.description"
                    />
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
                <form method="post" name="updatestudent" id="updatestudent" action="#" @submit.prevent="updateGradeSetting">
                  <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input type="text" name="percentage" id="percentage" class="form-control" placeholder="Percentage" v-model="setting.percentage"
                    />
                  </div>
                  <div class="form-group">
                    <label for="grade">Grade</label>
                    <input type="text"
                           name="grade"
                           id="grade"
                           class="form-control"
                           placeholder="Grade"
                           v-model="setting.grade" />
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description" v-model="setting.description"
                    />
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
                  <button class="btn btn-success" v-on:click="deleteGradeSetting()">Ok</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">GradeSettings List</div>
          <div class="card-body">

            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Percentage</th>
                  <th>Grade</th>
                  <th>Description</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="gSetting in laravelData.data" :key="gSetting.id">
                  <td>{{ gSetting.percentage }}</td>
                  <td>{{ gSetting.grade }}</td>
                  <td>{{ gSetting.description }}</td>
                  <td><a href="#"
                       v-on:click="editGradeSetting(gSetting.id)"
                       data-target="#exampleModal1"
                       data-toggle="modal"
                       v-bind:title="gSetting.id">Edit</a></td>
                  <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(gSetting.id)" data-toggle="modal" v-bind:id="id">Delete</a></td>
                </tr>
              </tbody>
              </tbody>
            </table>
            <pagination :data="laravelData" :limit="2" @pagination-change-page="gradeSettingLists">
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
        setting: {
          percentage: '',
          grade: '',
          description: ''
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
      gradeSettingLists(page) {
        if (typeof page === 'undefined') {
          page = 1
        }
        this.$http.get('http://127.0.0.1:8000/api/grades?page=' + page).then(response => {
          //this.posts = response.data.data;
          this.laravelData = response.data
          this.pagenumber = page
        })
      },
      addGradeSetting() {
        this.$http
          .post('http://127.0.0.1:8000/api/grades', {
            percentage: this.setting.percentage,
            grade: this.setting.grade,
            description: this.setting.description
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.setting.percentage = ''
            this.setting.grade = ''
            this.setting.description = ''
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
            this.gradeSettingLists(this.pagenumber)
          })
      },
      editGradeSetting(settingid) {
        this.$http.get('http://127.0.0.1:8000/api/grades/' + settingid).then(data => {
          this.setting.percentage = data.data.data.percentage
          this.setting.grade = data.data.data.grade
          this.setting.description = data.data.data.description
          this.id = settingid
        })
      },
      updateGradeSetting() {
        this.$http
          .patch('http://127.0.0.1:8000/api/grades/' + this.id, {
            percentage: this.setting.percentage,
            grade: this.setting.grade,
            description: this.setting.description
          })
          .then(data => {
            this.succmsg = false
            console.log(data)
            this.setting.percentage = ''
            this.setting.grade = ''
            this.setting.description = ''
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
            this.gradeSettingLists(this.pagenumber)
          })
      },
      deleteId(settingid) {
        this.id = settingid
      },
      deleteGradeSetting() {
        this.$http.delete('http://127.0.0.1:8000/api/grades/' + this.id).then(data => {
          this.succmsg = false
          var self = this
          setTimeout(function() {
            self.succmsg = true
          }, 3000)

          this.actionmsg = 'Data deleted successfully'
          this.gradeSettingLists(this.pagenumber)
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
      this.gradeSettingLists()
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
