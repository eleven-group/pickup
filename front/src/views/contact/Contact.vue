<template>
  <div>
    <el-row>
      <el-col :span="24">
        <el-card>
          <h3 align="center">
            N'hésitez plus et contactez-nous si vous avez des questions ou des signalements à propos d'attitudes
            que vous pourrez trouver déplacées ou incorrectes. Vous pouvez également nous envoyer un mail pour signaler un fonctionnement
            anormal de notre site :
          </h3>
          <el-form ref="form" :label-position="labelPosition" :model="form" label-width="200px">
            <el-form-item label="Votre nom">
              <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="Votre mail">
              <el-input v-model="form.mail"></el-input>
            </el-form-item>
            <el-form-item label="Motif de contact">
              <el-select v-model="form.subject" autosize placeholder="Sélectionnez votre motif">
                <el-option label="Signalement" value="report"></el-option>
                <el-option label="Problème technique" value="problem"></el-option>
                <el-option label="Suggestion" value="suggestion"></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="Description de votre demande">
              <el-input type="textarea" :autosize="{ minRows: 5, maxRows: 10}" v-model="form.desc"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="onSubmit">Créer</el-button>
            </el-form-item>
          </el-form>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
  data () {
    return {
      labelPosition: 'left',
      form: {
        name: '',
        mail: '',
        subject: '',
        resource: '',
        desc: ''
      }
    };
  },
  methods: {
    onSubmit () {
      console.log('submit!');
    }
  },
  name: 'Contact'
};
</script>

<style lang="scss" scoped>
.el-form {
  width: 60%;
  margin: 24px auto;
  margin-top: 48px;
}

h3,
label {
  line-height: 32px;
}

button ~ .el-form-item {
  text-align: right;
}
</style>
