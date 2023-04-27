import { Button, Box, Table, TableBody, TableCell, TableContainer, TableHead, TablePagination,
    TableRow, TableSortLabel, Toolbar, Typography, Paper, Checkbox, IconButton, Tooltip,
    FormControlLabel, Switch, Snackbar, Alert, Avatar } from '@mui/material';
import DeleteIcon from '@mui/icons-material/Delete';
import EditOutlined from '@mui/icons-material/EditOutlined';
import FilterListIcon from '@mui/icons-material/FilterList';
import { visuallyHidden } from '@mui/utils';
import PropTypes from 'prop-types';
import * as React from 'react';
import {useLocation, useNavigate, useParams, useState} from 'react-router-dom';
import axios from 'axios';
import { AllOut, ConstructionOutlined } from '@mui/icons-material';
import { getUserById, getUsers, deleteUser } from 'services/userService';


//test
import { styled } from '@mui/material/styles';
import Badge from '@mui/material/Badge';
const StyledBadge = styled(Badge)(({ theme }) => ({
  '& .MuiBadge-badge': {
    backgroundColor: '#44b700',
    color: '#44b700',
    boxShadow: `0 0 0 2px ${theme.palette.background.paper}`,
    '&::after': {
      position: 'absolute',
      top: 0,
      left: 0,
      width: '100%',
      height: '100%',
      borderRadius: '50%',
      animation: 'ripple 1.2s infinite ease-in-out',
      border: '1px solid currentColor',
      content: '""',
    },
  },
  '@keyframes ripple': {
    '0%': {
      transform: 'scale(.8)',
      opacity: 1,
    },
    '100%': {
      transform: 'scale(2.4)',
      opacity: 0,
    },
  },
}));
function createData(
  id,
  image,
  name,
  phone,
  birthday,
  address,
  status,
  active,
){
return { id,
    image,
    name,
    phone,
    birthday,
    address,
    status,
    active,
   };
}

// var rows=[
//   createData('1', "iphone 13",10000, 10, "this is a good","ch co")
// ]
// rows.push(  createData('2', "iphone 14",10000, 10, "this is a good","ch co"))


function descendingComparator(a, b, orderBy){
  if (b[orderBy] < a[orderBy]) {
  return -1;
  }
  if (b[orderBy] > a[orderBy]) {
  return 1;
  }
  return 0;
}

function getComparator(order,orderBy){
  return order === 'desc'
  ? (a, b) => descendingComparator(a, b, orderBy)
  : (a, b) => -descendingComparator(a, b, orderBy);
}

function stableSort(array, comparator) {
  const stabilizedThis = array.map((el, index) => [el, index]);

  stabilizedThis.sort((a, b) => {
  const order = comparator(a[0], b[0]);
  if (order !== 0) {
    return order;
  }
  return a[1] - b[1];
  });
  return stabilizedThis.map((el) => el[0]);
}

const headCells= [
{
id: 'id',
numeric: false,
disablePadding: false,
label: 'ID',
},
{
id: 'image',
numeric: true,
disablePadding: false,
label: 'Avatar',
},
{
id: 'name',
numeric: true,
disablePadding: false,
label: 'Name',
},
{
id: 'phone',
numeric: true,
disablePadding: false,
label: 'Phone',
},

{
id: 'birthday',
numeric: true,
disablePadding: false,
label: 'Birthday',
},
{
id: 'address',
numeric: true,
disablePadding: false,
label: 'Address',
},
{
id: 'situation',
numeric: true,
disablePadding: false,
label: 'Situation',
},
// {
// id: 'active',
// numeric: true,
// disablePadding: false,
// label: 'Active',
// }
];
const DEFAULT_ORDER = 'asc';
const DEFAULT_ORDER_BY = 'id';
const DEFAULT_ROWS_PER_PAGE = 5;


  const EnhancedTableHead = (props) => {
    const { onSelectAllClick, order, orderBy, numSelected, rowCount, onRequestSort } = props;
    const createSortHandler = (newOrderBy) => (event) =>{
    onRequestSort(event, newOrderBy);
  }
  return (
    <TableHead>
    <TableRow>
      <TableCell padding="checkbox">
        <Checkbox
          indeterminate={numSelected > 0 && numSelected < rowCount}
          checked={rowCount > 0 && numSelected === rowCount}
          onChange={onSelectAllClick}
          inputProps={{ 'aria-label': 'select all desserts' }}
        />
      </TableCell>
      {headCells.map((headCell) => (
        <TableCell
          key={headCell.id}
          align={headCell.numeric ? 'right' : 'left'}
          padding={headCell.disablePadding ? 'none' : 'normal'}
          sortDirection={orderBy === headCell.id ? order : false}
        >
          <TableSortLabel
            active={orderBy === headCell.id}
            direction={orderBy === headCell.id ? order : DEFAULT_ORDER}
            onClick={createSortHandler(headCell.id)}
          >
            {headCell.label}
            {orderBy === headCell.id ? (
              <Box component="span" sx={visuallyHidden}>
                {order === 'desc' ? 'sorted descending' : 'sorted ascending'}
              </Box>
            ) : null}
          </TableSortLabel>
        </TableCell>
      ))}
    </TableRow>
    </TableHead>
  );
};

EnhancedTableHead.propTypes = {
  numSelected: PropTypes.number.isRequired,
  onRequestSort: PropTypes.func.isRequired,
  onSelectAllClick: PropTypes.func.isRequired,
  order: PropTypes.oneOf(['asc', 'desc']).isRequired,
  orderBy: PropTypes.string.isRequired,
  rowCount: PropTypes.number.isRequired,
};

function EnhancedTableToolbar(props){
  const {numSelected, ids, handleDelete} = props;

// i have no i  dea

const [open, setOpen] = React.useState(false);
const handleClose = () =>{
  setOpen(false);
}
  const navigate = useNavigate();


  const handleEdit = () => {
    if(ids.length>2){
        setOpen(true);
        navigate('/users');
      } else{
      navigate(`/user/${ids}/edit`); 
      }
    }
  return (
<Toolbar
sx={{
  pl: { sm: 2 },
  pr: { xs: 1, sm: 1 },
  ...(numSelected > 0 && {
    bgcolor: (theme) =>
      theme.palette.mode === 'light'
        ? theme.palette.primary.main
        : theme.palette.primary.dark,
  }),
}}
>
{numSelected > 0 ? (
  <Typography
    sx={{ flex: '1 1 100%' }}
    color="inherit"
    variant="subtitle1"
    component="div"
  >
    {numSelected} selected
  </Typography>
) : (
  <Typography
    sx={{ flex: '1 1 100%' }}
    variant="h6"
    id="tableTitle"
    component="div"
  >

  </Typography>
)}
{numSelected > 0 ? (
  <>
  <Tooltip title="edit">
    <IconButton onClick={handleEdit}>
      <EditOutlined />
    </IconButton>
  </Tooltip>
  <Tooltip title="Delete">
    <IconButton onClick={handleDelete}>
      <DeleteIcon />
    </IconButton>
  </Tooltip></>) : (
  <Tooltip title="Filter list">
    <IconButton>
      <FilterListIcon />
      </IconButton>
      </Tooltip>
            )}

    <Snackbar
    anchorOrigin={{ vertical: 'top', horizontal: 'center' }}
    open={open}
    onClose= {handleClose}
    message="Chỉ được chọn một sản phẩm để sửa!"
    >
        <Alert onClose={handleClose} severity="error" sx={{ width: '100%' }}>
            Chỉ được chọn một sản phẩm để sửa!
        </Alert>
    </Snackbar>
</Toolbar>



  );
}
EnhancedTableToolbar.propTypes = {
  numSelected: PropTypes.number.isRequired,
  ids: PropTypes.string.isRequired,
  handleDelete: PropTypes.func.isRequired,
}

const ListUser = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [rows, setRows] = React.useState([]); 
  const [order, setOrder] = React.useState(DEFAULT_ORDER);
  const [orderBy, setOrderBy] = React.useState(DEFAULT_ORDER_BY);
  const [selected, setSelected] = React.useState([]);
  const [page, setPage] = React.useState(0);
  const [rowsPerPage, setRowsPerPage] = React.useState(DEFAULT_ROWS_PER_PAGE);
  const [visibleRows, setVisibleRows] = React.useState(null);
  const [paddingHeight, setPaddingHeight] = React.useState(0);
  const [dense, setDense] = React.useState(false);

  const handleDelete = async () =>{
  const response = await deleteUser(selected);
  if(response.status === 200){
    alert("Xóa thành công");
    const updateRows = rows.filter((row) => !selected.includes(row.id));
    setRows(updateRows);
  // window.location.href = '/product';
  } 
  else{
    alert("Xóa thất bại");
  }
  }


React.useEffect(() => {
  async function fetchData() {
  try {
    const response = await getUsers();
    const newData = response.map((user) => {
      console.log(user.birthday);
      return createData(user.id, user.image, user.name, user.phone, user.birthday, user.address, user.status, user.active);
    }); 
    setRows(newData);
    console.log(newData);
  } catch (error) {
    console.error(error);
  }
  }
fetchData();
}, []);


React.useEffect( ()=> {
  let RowOnMount = stableSort(
    rows,
    getComparator(DEFAULT_ORDER, DEFAULT_ORDER_BY),
  );
  RowOnMount = RowOnMount.slice(0* DEFAULT_ROWS_PER_PAGE, 0*DEFAULT_ROWS_PER_PAGE + DEFAULT_ROWS_PER_PAGE);
  setVisibleRows(RowOnMount);
}, [rows]);


const handleRequestSort = React.useCallback(
  (event, newOrderBy) => {
  const isAsc = orderBy === newOrderBy && order === 'asc'; //careful
  const toggleOrder = isAsc ? 'desc' : 'asc';
  setOrder(toggleOrder);
  setOrderBy(newOrderBy);
  const sortedRows = stableSort(rows, getComparator(toggleOrder, newOrderBy));
  const updateRows = sortedRows.slice(
  page* rowsPerPage,
  page *  rowsPerPage + rowsPerPage,
  );
  setVisibleRows(updateRows);
  },
  [order, orderBy, page, rowsPerPage]
)
const handleSelectAllClick = (event)=>{
if(event.target.checked){
const newSelecteds = rows.map((n) => n.name);
setSelected(newSelecteds);
return;
}
setSelected([]);
}
const handleClick = (event, id) =>{
const selectedIndex = selected.indexOf(id);
let newSelected = [];
if(selectedIndex === -1){
newSelected = newSelected.concat(selected, id);
} else if(selectedIndex === 0 ){
newSelected = newSelected.concat(selected.slice(1));
} else if( selectedIndex === selected.length -1 ){
newSelected = newSelected.concat(selected.slice(0, -1));
} else if( selectedIndex >0){
newSelected = newSelected.concat(selected.slice(0, selectedIndex), selected.slice(selectedIndex +1));
}
setSelected(newSelected);
}
const handleChanePage = React.useCallback(
(event, newPage) => {
setPage(newPage);
const updateRows = rows.slice(
newPage * rowsPerPage,
newPage * rowsPerPage + rowsPerPage,
);
setVisibleRows(updateRows);

const numEmptyRows = 
newPage > 0 ? Math.max(0, (1 + newPage) * rowsPerPage - rows.length) : 0;
const newPaddinHeight = (dense ? 33 : 53) * numEmptyRows;
setPaddingHeight(newPaddinHeight);
},
[order, orderBy, dense, rowsPerPage],
);
const handleRowsPage = React.useCallback(
(event) => {
const updateRowsPerPage = parseInt(event.target.value, 10);
setRowsPerPage(updateRowsPerPage);
setPage(0);
const sortedRows = stableSort(rows, getComparator(order, orderBy));
const updateRows = sortedRows.slice(0* updateRowsPerPage,0* updateRowsPerPage+ updateRowsPerPage);

setVisibleRows(updateRows);
setPaddingHeight(0);
},
[order, orderBy],
);
const handleChangeDense = (event) => {
setDense(event.target.checked);
};
const isSelected = (id) => selected.indexOf(id) !== -1; //careful

//careful

return (
<div>
  <h1>List User</h1>
  {/* <Button onClick={() =>{navigate('/product/create')} }>Add new product</Button> */}
  <Box sx={{width: '100%'}}>
    <Paper sx={{width: '100%', mb: 2}}>
      <EnhancedTableToolbar numSelected={selected.length} ids={selected.join(',')} handleDelete={handleDelete}/>
      <TableContainer>
        <Table
          sx={{ minWidth: 750 }}
          aria-labelledby="tableTitle"
          size={dense ? 'small' : 'medium'}
        >
          <EnhancedTableHead
            numSelected={selected.length}
            order={order}
            orderBy={orderBy}
            onSelectAllClick={handleSelectAllClick}
            onRequestSort={handleRequestSort}
            rowCount={rows.length}
          />
          <TableBody>

            {visibleRows ? visibleRows.map((row, index) => {
              const isItemSelected = isSelected(row.id);
              const labelId = `enhanced-table-checkbox-${index}`;
              return (
                <TableRow
                  hover
                  onClick={(event) => handleClick(event, row.id)}
                  role="checkbox"
                  aria-checked={isItemSelected}
                  tabIndex={-1}
                  key={row.id}
                  selected={isItemSelected}
                >

                  <TableCell padding="checkbox">
                    <Checkbox
                      checked={isItemSelected}
                      inputProps={{ 'aria-labelledby': labelId }}
                    />
                  </TableCell>
                  <TableCell component="th" id={labelId} scope="row" padding="none">
                     {row.id}
                  </TableCell>

                  <TableCell align="right">
                    {row.active == 1 ? (
                      <StyledBadge
                        overlap="circular"
                        anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
                        variant="dot"
                      >
                        <Avatar alt="Remy Sharp" src={'http://localhost:80/image/customer/'+row.image} />
                      </StyledBadge>
                    ) : (
                      <Avatar alt="Remy Sharp" src={'http://localhost:80/image/customer/'+row.image} style={{ marginRight: '0vw' }} />
                    )}
                  </TableCell>
                  <TableCell align="right">{row.name}</TableCell>
                  <TableCell align="right">{row.phone}</TableCell>
                  <TableCell align="right">{row.birthday}</TableCell>
                  <TableCell align="right">{row.address}</TableCell>
                  <TableCell align="right">{row.status}</TableCell>
                  
                </TableRow>
              );
            }) : <div>loading...</div>}
            {paddingHeight > 0 && (
            <TableRow style={{ height: paddingHeight }}>
              <TableCell colSpan={6} />
            </TableRow>
            )}

          </TableBody>
        </Table>
      </TableContainer>
      <TablePagination
        rowsPerPageOptions={[5, 10, 25]}
        component="div"
        count={rows.length}
        rowsPerPage={rowsPerPage}
        page={page}
        onPageChange={handleChanePage}
        onRowsPerPageChange={handleRowsPage}
      />
    </Paper>
    <FormControlLabel
      control={<Switch checked={dense} onChange={handleChangeDense} />}
      label="Dense padding"
    />
  
  </Box>
</div>
)

  }

export default ListUser;