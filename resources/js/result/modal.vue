<template>

<!-- Modal -->

<div class="">

  <div class="modal-active">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Result Card</h5>
                  <button type="button" @click="$emit('close')" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col lead">
                          Student Name : {{student.name}}
                      </div>
                      <div class="col">
                          Roll# : {{student.roll_no}}
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          Father Name : {{student.father_name}}
                      </div>
                      <div class="col">
                          Contact# : {{student.contact}}
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
                          <tr v-for="result in student.results" :key="result.subject">
                              <td>{{ result.subject }}</td>
                              <td>{{ result.total_marks }}</td>
                              <td>{{ result.obtain_marks }}</td>
                              <td>{{ result.grade }}</td>
                              <td>{{ status(result.percentage) }}</td>
                          </tr>
                          <tr>
                              <td colspan="2" class="text-center"> Total :</td>
                              <td colspan="3" class="text-center">{{ student.total }}</td>
                          </tr>
                          <tr>
                              <td colspan="2" class="text-center"> Obtain :</td>
                              <td colspan="3" class="text-center">{{ student.obtain }}</td>
                          </tr>
                          <tr>
                              <td colspan="2" class="text-center"> Percentage :</td>
                              <td colspan="3" class="text-center">{{ ((student.obtain*100)/student.total).toFixed(2) }}</td>
                          </tr>
                          <tr>
                              <td colspan="2" class="text-center"> Remarks :</td>
                              <td colspan="3" class="text-center">{{ student.remarks }}</td>
                          </tr>
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
    props: ['student'],

    methods: {
        status($per) {
                return $per >= 33 ? 'Pass' : 'Fail'
            },
    },

}

</script>

<style scoped>

.modal-active{
	display:block;
}

</style>
