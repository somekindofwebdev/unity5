export default {
    props: {
        first_name: String,
        middle_name: String,
        last_name: String,
        date_of_birth: String,
        address: String,
        postcode: String,
        telephone_number: String,
        email: String
    },
  template: `
    <label for="editor-firstname">First name:</label>
    <input id="editor-firstname" type=text v-model="contact.first_name"  />
  `
}