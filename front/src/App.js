import React, {useState} from 'react';
import  "./styles/main.module.css"

import {BrowserRouter, Route, Routes} from "react-router-dom";
import Products from "./pages/Products";
import AddProduct from "./pages/AddProduct";
import {Loading} from "./context";

function App() {


const [loading,setLoading]=useState(false);
  return (
      <div className='App'>

          <Loading.Provider value={{
              loading,
              setLoading
          }}>
        <BrowserRouter >

         <Routes>

                <Route path="/" element={<Products/>}/>
                <Route path="/addproduct" element={<AddProduct/>}/>
         </Routes>


        </BrowserRouter>
          </Loading.Provider>
      </div>
  );
}

export default App;
