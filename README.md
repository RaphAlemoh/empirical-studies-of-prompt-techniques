# Empirical Study of Prompt Techniques on Code Generation from Open-Source LLMs

# Evaluating Prompt Engineering Techniques for PHP Code Generation  
*A Reproducible Research Repository*

## Overview

This repository provides a fully reproducible experimental environment for evaluating **prompt engineering techniques**—Zero-Shot, Few-Shot, and Chain-of-Thought—applied to **PHP code generation** using **open-source large language models (LLMs)**.

The evaluation focuses exclusively on **coding challenge tasks** (e.g., LeetCode-style problems) to isolate reasoning and algorithmic code generation ability, independent of any web frameworks. The repository is designed for **academic replication**, **controlled experimentation**, and **comparative analysis across models**.

---

## System Requirements

- AWS EC2 instance
- Ubuntu 20.04
- GPU-enabled Deep Learning AMI (CUDA preinstalled)
- PHP 8.x
- Ollama

---

## Infrastructure Setup (AWS EC2)

### Step 1: Launch an EC2 Instance

1. Log in to the **AWS Management Console**
2. Navigate to **EC2 → Launch Instance**
3. Configure the instance as follows:

**AMI**
- Deep Learning AMI (Ubuntu 20.04)  
  *(Includes CUDA and GPU drivers preinstalled)*

**Instance Type**
- `t3.xlarge`

**Storage**
- `120 GB` (LLM model artifacts are large)

**Security Group**
- Allow **SSH (port 22)** from your IP address

4. Launch the instance and download the `.pem` SSH key
5. Connect to the instance:

```bash
ssh -i your-key.pem ubuntu@<EC2_PUBLIC_IP>


## Model Runtime Installation

### Install Ollama

Ollama is used to run open-source large language models (LLMs) locally.

    curl -fsSL https://ollama.com/install.sh | sh

# Check Disk Size
    - df -h

## Model Configuration

To ensure deterministic and comparable experimental results:

This configuration is mandatory for all experiments.
#export OLLAMA_NUM_PARALLEL=1
#export OLLAMA_MAX_LOADED_MODELS=1
#export OLLAMA_TEMPERATURE=0.8 //default temperature

### Start the Service

    ollama serve

### Verify Installation

    ollama --version

Official documentation: https://ollama.com/

https://ollama.com/library/starcoder2:3b

https://ollama.com/library/mistral:7b

https://ollama.com/library/codellama:7b

## Model Installation

### Code-Focused Models

#### Code LLaMA (7B – Quantized)

    ollama pull codellama:7b
    ollama run codellama:7b

#### StarCoder

    ollama pull starcoder2:3b
    ollama run starcoder2:3b

### General Reasoning Baseline

#### Mistral (7B)

    ollama pull mistral:7b
    ollama run mistral:7b

### List Installed Models

    ollama list

## Experimental Directory Structure

A fixed directory layout is enforced to ensure consistency and reproducibility across all experiments.

    mkdir -p directory_name/

## Directory Semantics
    Take a look at the directory structure in the repository

## Task Category (Dataset)
- easy, medium and hard from leetcode exercises

Remove any directory if required:

rm -rf folder_name

## PHP Environment Setup

### Install PHP and Required Extensions

    sudo apt update
    sudo apt install -y php php-cli php-xml php-mbstring php-curl unzip

### Verify Installation

    php -v

## Dependency Management

### Install Composer

    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer

### Verify Installation

    composer --version

## Testing and Code Quality Tooling

### PHPUnit (Unit Testing)

    composer require --dev phpunit/phpunit

### Static Analysis and Style Checking

    composer require --dev phpmd/phpmd
    composer require --dev squizlabs/php_codesniffer

These tools support evaluation of:

- Functional correctness  
- Code quality  
- Standards compliance  

## Experiment Execution Workflow

1. Select:
   - LLM (Code LLaMA, StarCoder, and Mistral)
   - Prompt strategy (Zero-Shot, Few-Shot, or Chain-of-Thought)
   - Task category


## Bundle Remote Experiments folder
sudo apt update
sudo apt install zip -y

# To zip a project on aws and download it to local machine
cd /home/ubuntu
zip -r model_outputs.zip model_outputs

scp -i thesis-mistral.pem ubuntu@18.XXX.XXX.74:./prompt-empirical-study/model_outputs.zip .

#if error encountered 
chmod 400 thesis-mistral.pem

## Upload Prompt Templates directory to aws ecII console project folder

scp -i thesis-mistral.pem -r ./prompts_templates ubuntu@3.8.202.219:/home/ubuntu/prompt-empirical-study


# Experiment Execution Workflow

- Define prompt templates (Zero-Shot, Few-Shot, Chain-of-Thought).
- Run generation script to produce model outputs.
- Store outputs in the appropriate task directory.
- Run PHP extraction script to isolate the required function.
- Use the tests folder (predefined test values).
- Run evaluator scripts for each task.
- Store evaluation results in CSV format.
- Perform graphical and statistical analysis.

## Reproducibility Guidelines

- Temperature is left on default  
- Tasks are framework-independent  
- PHP version and tooling are explicitly defined  
- Directory structure must not be altered or when altered the execution pipeline scripts need to be modified 
- All generated artifacts are preserved for auditability  

## Intended Audience

This repository is intended for:

- Software Engineering researchers  
- LLM evaluation and benchmarking studies  
- MSc and PhD replication studies  
- Practitioners comparing open-source code models  

## License

This repository is provided for academic and research purposes only.  
Please review individual LLM licenses for usage restrictions.

## Citation

If you use this repository in your research, please cite the associated thesis or publication.

## Author

Rapheal Alemoh Baja
MSc Research – Empirical Study of Prompt Engineering Techniques for Code Generation using Open Source LLMs in software Engineering


