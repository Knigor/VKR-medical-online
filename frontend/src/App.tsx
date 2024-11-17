import { useState } from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Profile from "./pages/Profile";
import Layout from "./components/Layouts";
import Consultation from "./pages/Consultation";
import { MainPage } from "./pages/MainPage";
import ErrorPage from "./pages/ErrorPage";

function App() {
  return (
    <>
      <BrowserRouter future={{ v7_startTransition: true }}>
        <Routes>
          <Route path="/" element={<Layout />}>
            <Route index element={<MainPage />}></Route>
            <Route path="/profile" element={<Profile />} />
            <Route path="/consultation" element={<Consultation />} />
          </Route>
          <Route path="*" element={<ErrorPage />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}

export default App;
