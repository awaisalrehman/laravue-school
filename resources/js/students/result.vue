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
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             v-bind:class="{ showmodal:showmodal }">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Result Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col lead">
                    Student Name : {{studentResult.name}}
                  </div>
                  <div class="col">
                    Roll# : {{studentResult.roll_no}}
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    Father Name : {{studentResult.father_name}}
                  </div>
                  <div class="col">
                    Contact# : {{studentResult.contact}}
                  </div>
                </div>
                <table class="mt-3 table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Total Marks</th>
                      <th>Obtain Marks</th>
                      <th>Grade</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="result in studentResult.results" :key="result.subject">
                      <td>{{ result.subject }}</td>
                      <td>{{ result.total_marks }}</td>
                      <td>{{ result.obtain_marks }}</td>
                      <td>{{ result.grade }}</td>
                      <td>{{ status(result.percentage) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center"> Total :</td>
                      <td colspan="3" class="text-center">{{ studentResult.total }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center"> Obtain :</td>
                      <td colspan="3" class="text-center">{{ studentResult.obtain }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center"> Percentage :</td>
                      <td colspan="3" class="text-center">{{ ((studentResult.obtain*100)/studentResult.total).toFixed(2) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center"> Remarks :</td>
                      <td colspan="3" class="text-center">{{ studentResult.remarks }}</td>
                    </tr>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in students" :key="student.id">
                  <th scope="row">{{ student.roll_no }}</th>
                  <td>{{ student.name }}</td>
                  <td>{{ student.father_name.slice(0,50) + "....." }}</td>
                  <td>{{ student.gender }}</td>
                  <td><a href="#"
                       v-on:click="getResultofStudent(student.id)"
                       data-target="#exampleModal"
                       data-toggle="modal"
                       v-bind:title="student.name">Result</a></td>

                </tr>
              </tbody>
              </tbody>
            </table>
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
        students: [],
        studentResult: {},
        grades: {},
        id: '',
        succmsg: true,
        showmodal: false,
        pagenumber: 1,
        actionmsg: ''
      }
    },
    methods: {
      studentLists() {
        this.$http.get('http://127.0.0.1:8000/api/students').then(response => {
          this.students = response.data.data
        })
      },
      getResultofStudent(studentid) {
        this.$http.get('http://127.0.0.1:8000/api/results/student/' + studentid).then(response => {
          this.studentResult = response.data
        })
      },
      status($per){
        return ($per >= 33) ? 'Pass' : 'Fail';
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
