<template>

  <div class="container mt-5">
    <div v-bind:class="{ succmsg: succmsg }">
      <div class="col-md-12 col-lg-12">
        <div class="alert alert-success">Data inserted successfully</div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 com-lg-7  offset-md-3">
        <form method="post"
              name="addpost"
              id="addpost"
              action="#"
              enctype="multipart/form-data"
              @submit.prevent="subjectStudents(subject_id)">
          <div class="form-group">
            <label for="subject_id">Subject</label>
            <select class="form-control" name="subject_id" id="subject_id" v-model="subject_id">
                <option v-for="subject in subjects" v-bind:value="subject.id">
                  {{ subject.name }}
                </option>
              </select>
          </div>
          <div class="form-group">
            <label for="total_marks">Total Marks</label>
            <input type="text" name="total_marks" id="total_marks" class="form-control" placeholder="Total Marks" v-model="total_marks"
            />
          </div>

          <div class="form-group text-center">
            <button @click="subject_id && marks.length ? seen = true : seen = false" class="btn btn-primary">List Student</button>
          </div>
        </form>
      </div>
    </div>

    <form id="marksfeeding" @submit.prevent="submitFormData">
      <div v-if="marks.length" class="card mt-5">
        <div class="card-header">Students List</div>
        <div class="card-body">

          <table class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Roll#</th>
                <th>Student Name</th>
                <th>Obtain Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="obj in marks" :key="obj.student_id">
                <th scope="row">{{ obj.student_roll_no }}</th>
                <td>{{ obj.student_name }}</td>
                <!-- assign total marks here -->

                <td><input class="form-control" type="number" min="0" v-bind:max="total_marks" v-model="obj.obtain_marks"></td>
              </tr>
            </tbody>
            </tbody>
          </table>
        </div>
        <div class="card-footer text-center">
          <button class="btn btn-success">Save</button>
        </div>
      </div>
    </form>

  </div>

</template>

<script>

  export default {
    data() {
      return {
        marks: [],
        seen: false,
        subjects: [],
        subject_id: '',
        total_marks: '',
        succmsg: true,
        actionmsg: ''
      }
    },
    methods: {
      subjectList() {
        this.$http.get('http://127.0.0.1:8000/api/subjectlist').then(response => {
          this.subjects = response.data.data;
        })
      },
      subjectStudents: function(subjectid) {
        if (typeof subjectid === 'number') {
          this.$http.get('http://127.0.0.1:8000/api/subjectstudents/subject/' + subjectid).then(response => {
            this.marks = response.data;
            if (this.marks[0].total_marks > 0) {
              this.total_marks = this.marks[0].total_marks;
            }
          })
        }
      },
      submitFormData: function() {
        for (var i = 0; i < this.marks.length; i++) {
          this.marks[i].total_marks = this.total_marks;
        }

        // let json = JSON.stringify(this.marks);
        let post_data = {data: this.marks}

        // var form = document.getElementById('marksfeeding')
        // var formData = new FormData(form)
        // var object = {}
        // formData.forEach(function(value, key) {
        //   object[key] = value
        // })
        // var json = JSON.stringify(object)
        this.$http
          .post('http://127.0.0.1:8000/api/subjectresult', this.marks)
          .then(data => {
            this.succmsg = false
            this.seen = false
            console.log(data)
            this.subject_id = ''
            this.total_marks = ''
            this.marks = []
            this.students = []
            this.subjects = []
            var self = this
            setTimeout(function() {
              self.succmsg = true
            }, 3000)
            this.actionmsg = 'Data inserted successfully'
            this.subjectList()
          })
      }
    },
    mounted() {
      this.subjectList()
    }
  }

</script>

<style scoped>

  .succmsg {
    display: none;
  }

</style>
