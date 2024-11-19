import { createSlice } from "@reduxjs/toolkit";
import type { PayloadAction } from "@reduxjs/toolkit";
import type { RootState } from "./store";

type UserState = {
  isAuth: boolean;
  name: string;
  email: string;
};

const initialState: UserState = {
  isAuth: false,
  name: "",
  email: "",
};

export const userSlice = createSlice({
  name: "user",
  initialState,

  reducers: {
    setIsAuth: (state, action: PayloadAction<boolean>) => {
      state.isAuth = action.payload;
    },
    resetIsAuth: (state) => {
      state.isAuth = initialState.isAuth;
    },
  },
});

// Actions

export const { setIsAuth, resetIsAuth } = userSlice.actions;

// Async actions

// Selectors

export const selectIsAuth = (state: RootState) => state.user.isAuth;

// Reducer
export default userSlice.reducer;
