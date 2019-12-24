<template>

  <div id="postsrec" class="mt-5">

    <div class="row justify-content-center">
      <div class="col-md-12">

        <modal v-if="showmodal" @close="showmodal = false" :student="student"></modal>

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
                       v-bind:title="student.name">Result Card</a>
                  </td>
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

import modal from './modal';

  export default {

    components: {
      modal,
    },

    data() {
      return {
        students: [],
        student: {},
        showmodal: false,
        pagenumber: 1,
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
          this.student = response.data;
          this.showmodal = true;
        })
      },
      result(student) {
        return student.total;
      },
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
