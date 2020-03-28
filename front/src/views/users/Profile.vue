<template>
  <div>
    <el-row type="flex" justify="center">
      <el-col :span="16">
        <el-card class="clearfix">
          <div>
            <el-tooltip class="item edit-button" effect="dark" content="Edit your profile" placement="left-start">
              <el-button type="primary" icon="el-icon-edit" circle></el-button>
            </el-tooltip>
           </div>
          <div class="clearfix-top">
              <img class="avatar-logo" src="../../assets/logo.png" />
              <h1>Louis HARANG</h1>
              <p class="role"> Développeur </p>
              <p class="bio"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
          </div>
        </el-card>
        <el-card class="clearfix">
          <h2> Informations </h2>
          <p> Email : lharang.pro@gmail.com </p>
          <p> Address : 15 rue notre Dame </p>
          <p> City : Montmorency </p>
          <p> Postal Code : 95160 </p>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<style scoped>
  .avatar-logo{
    border-radius: 50px;
    height: 150px;
  }
  .role{
    font-weight: 600;
  }
  .bio{
    text-align: justify;
  }
  .clearfix{
    margin-bottom: 20px;
  }
  .clearfix-top{
    margin-top: 50px;
  }
  .edit-button{
    float: right;
  }
</style>
<script>
export default {
  name: 'Profile'
};
</script>
