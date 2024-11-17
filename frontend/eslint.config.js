import { config as jsConfig } from "@eslint/js";
import { config as globalsConfig } from "globals";
import { config as reactHooksConfig } from "eslint-plugin-react-hooks";
import { config as reactRefreshConfig } from "eslint-plugin-react-refresh";
import { config as tseslintConfig } from "typescript-eslint";

export default tseslintConfig(
  { ignorePatterns: ["dist"] },
  {
    extends: [jsConfig.recommended, ...tseslintConfig.recommended],
    files: ["**/*.{ts,tsx}"],
    languageOptions: {
      ecmaVersion: 2020,
      globals: globalsConfig.browser,
    },
    plugins: {
      "react-hooks": reactHooksConfig,
      "react-refresh": reactRefreshConfig,
    },
    rules: {
      ...reactHooksConfig.rules,
      "react-refresh/only-export-components": [
        "warn",
        { allowConstantExport: true },
      ],
      "no-unused-vars": "off",
    },
  }
);
