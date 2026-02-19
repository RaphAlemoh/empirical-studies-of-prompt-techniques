# Commands Folder

## Overview

The `commands/` folder contains shell scripts used to generate model outputs for each coding problem (CP-01 to CP-06).

These scripts automate the process of prompting selected models and storing their generated code responses for evaluation.

---

## Script File

`generate_prompt_output.sh`

This script is responsible for:

- Sending prompts to the specified model  
- Generating code output for a selected task  
- Saving the generated response for later evaluation  

---

## Setup

Make the script executable:

```bash
chmod +x generate_prompt_output.sh

./generate_prompt_output.sh

# outside of the commands folder
./commands/generate_prompt_output.sh codellama:7b CP-01
./commands/generate_prompt_output.sh mistral:7b CP-01
./commands/generate_prompt_output.sh starcoder2:3b CP-01

./commands/generate_prompt_output.sh codellama:7b CP-02
./commands/generate_prompt_output.sh starcoder2:3b CP-02
./commands/generate_prompt_output.sh mistral:7b CP-02

./commands/generate_prompt_output.sh codellama:7b CP-03
./commands/generate_prompt_output.sh starcoder2:3b CP-03
./commands/generate_prompt_output.sh mistral:7b CP-03


./commands/generate_prompt_output.sh codellama:7b CP-04
./commands/generate_prompt_output.sh starcoder2:3b CP-04
./commands/generate_prompt_output.sh mistral:7b CP-04

./commands/generate_prompt_output.sh codellama:7b CP-05
./commands/generate_prompt_output.sh starcoder2:3b CP-05
./commands/generate_prompt_output.sh mistral:7b CP-05

./commands/generate_prompt_output.sh codellama:7b CP-06
./commands/generate_prompt_output.sh starcoder2:3b CP-06
./commands/generate_prompt_output.sh mistral:7b CP-06