import React, {useState} from 'react'
import { Box, useMediaQuery} from '@mui/material';
import { Outlet } from 'react-router-dom';
import { useSelector } from 'react-redux';
import Navbar from "components/Navbar";
import Sidebar from "components/Sidebar";
const Layout = () => {
  const isPc = useMediaQuery("(min-width: 600px)");
  const [openSidebar, setOpenSidebar] = useState(true);


  return (
  <Box display={isPc ? "flex" : "block"} width="100%" height="100%">
    <Sidebar
    isPc = {isPc}
    drawerWidth = "250px"
    openSidebar= {openSidebar}
    setOpenSidebar = {setOpenSidebar}
    />
    <Box flexGrow={1}>
      <Navbar 
        openSidebar= {openSidebar}
        setOpenSidebar = {setOpenSidebar}
      />
      <Outlet />
    </Box>
  </Box>
  );
}
export default Layout;