import React from 'react';

import {
    Box,
    Divider,
    Drawer,
    List,
    ListItem,
    ListItemIcon,
    ListItemText,
    IconButton,
    Typography,
    useTheme,
    ListItemButton
} from '@mui/material'

import{
    ChevronLeft,
    ChevronRightOutlined,
    HomeOutlined,
    ShoppingCartOutlined,
    Groups2Outlined,
    ReceiptLongOutlined,
    PublicOutlined,
    PointOfSaleOutlined,
    TodayOutlined,
    CalendarMonthOutlined,
    AdminPanelSettingsOutlined,
    TrendingUpOutlined,
    PieChartOutline,
    AddBoxOutlined
}
from '@mui/icons-material';
import { useEffect, useState } from 'react';
import {useLocation, useNavigate} from 'react-router-dom';
import FlexBetween from './FlexBetween';
import profileImage from 'assets/profile.jpg';

const navItems = [
    {
        name: "Dashboard",
        icon: <HomeOutlined />,
    },
    {
        name: "Client",
        icon: null,
    },
    {
        name: "Orders",
        icon: <ShoppingCartOutlined/>,
    },
    {
        name: "Users",
        icon: <Groups2Outlined />,
    },
    {
        name: "Sale",
        icon: null,
    },
    {
        name: "Product",
        icon: <PointOfSaleOutlined />,
    },

    {
        name: "Create",
        icon: <AddBoxOutlined />,
    },
    {
        name: "Function",
        icon: null,
    },
    {
        name: "Logout",
        icon: <PieChartOutline />,
    },
]


const Sidebar = ({
    isPc, drawerWidth, openSidebar, setOpenSidebar
}) => {
    const theme = useTheme();
    const {pathname} = useLocation();
    const navigate = useNavigate();
    const [active, setActive] = useState(''); 


    useEffect(() => {
        setActive(pathname.substring(1));
    }, [pathname]);


  return (
    <Box component="nav">
        {openSidebar && (
            <Drawer
            open={openSidebar}  
            onClose = {() => setOpenSidebar(false)}
            variant='persistent'
            anchor='left'
            sx={{
                width: drawerWidth,
                "& .MuiDrawer-paper" : {
                    width: drawerWidth,
                    boxSizing: "border-box",
                    color: theme.palette.secondary[200],
                    backgroundColor: theme.palette.background.alt,
                    borderWidth: isPc ? "0px" : "1px",
                }
            }}>
                <Box width ="100%">
                    <Box m="1.5rem 1rem 1rem 4rem">
                        <FlexBetween color={theme.palette.secondary.main}>
                            <Box display="flex" alignItems = "center" gap= "0.5rem">
                                <Typography variant = "h4" fontWeight="bold">
                                Admin
                                </Typography>
                            </Box>
                            { !isPc && (
                                <IconButton onClick={() => setOpenSidebar(!openSidebar)}>
                                    <ChevronLeft />
                                </IconButton>
                            )}
                        </FlexBetween>
                    </Box>
                            <List>
                                {navItems.map(({name, icon}) => {
                                    if(!icon){
                                        return (
                                            <Typography key = {name} m= "2.25rem 0 1rem 3rem">
                                            {name}
                                            </Typography>   

                                        )
                                    }
                                    const lcText = name.toLowerCase();
                                    return (
                                        <ListItem key={name} disablePadding>
                                            <ListItemButton
                                                onClick = {()=> {
                                                    console.log(lcText); 
                                                    navigate(`/${lcText}`); 
                                                    setActive(lcText);
                                                }}
                                                sx={{
                                                    color: active === lcText ? theme.palette.primary[1000] : theme.palette.secondary[200],
                                                    backgroundColor: active === lcText ? theme.palette.secondary[600]: "transparent",
                                                    "&:hover": {
                                                        backgroundColor: theme.palette.primary[50],
                                                    },
                                                    "&.Mui-selected": {
                                                        backgroundColor: theme.palette.secondary[100],
                                                        color: theme.palette.primary[600],
                                                    },
                                                }}  

                                            >
                                                <ListItemIcon
                                                    sx={{
                                                        color: active === lcText ? theme.palette.primary[600] : theme.palette.secondary[200],
                                                        ml: "2rem",

                                                        }}>
                                                    {icon}  
                                                </ListItemIcon>
                                                <ListItemText primary={name} />
                                                {active === lcText && (
                                                    <ChevronRightOutlined  ml= "auto"/>
                                                )}
                                            </ListItemButton>

                                        </ListItem>
                                    );
                                })}
                          </List>
                </Box>
            </Drawer>
        )}    
    </Box>
  )
}

export default Sidebar