import React from 'react';
import  "./styles/main.module.css"

import {BrowserRouter, Route, Routes} from "react-router-dom";
import Products from "./pages/Products";
import AddProduct from "./pages/AddProduct";

function App() {



  return (
      <div className='App'>
        <BrowserRouter >

         <Routes>

                <Route path="/" element={<Products/>}/>
                <Route path="/addproduct" element={<AddProduct/>}/>
         </Routes>


        </BrowserRouter>
      </div>
  );
}

export default App;
