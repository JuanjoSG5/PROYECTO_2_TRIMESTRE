- When using data to declare a state and methods you have to use this.state
- In vue there is a function to map an array  like

  - v-for :

    ```javascript
    <div v-for="item in items" :key="item.id">
      {{ item }}
    </div>



    ```


- Just like there exists a v-for, you also have v-if
  ```javascript
  <div id="app">
    <p v-if="showMessage">This message is displayed because showMessage is true.</p>
    <p v-else>This message is displayed when showMessage is false.</p>
  </div>
  ```
- It is recommended not to use v-for and v-if in the same component since v-if has proprity over v-for
