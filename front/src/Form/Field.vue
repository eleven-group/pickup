<template>
  <div>
    <label :for="fieldName">{{label}}</label>
    <el-input
      :id="fieldName"
      :ref="fieldName"
      class="m-5"
      v-model="model">
    </el-input>
    <p v-if="isErrorForField(label, errors)">{{ getErrorForField(label, errors) }}</p>
  </div>
</template>

<script>

export default {
  name: 'Field',
  props: ['label', 'fieldName', 'model', 'errors', 'isErrorForField', 'getErrorForField']
};
</script>
