#include <stdio.h>
#include <stdlib.h>
#include <netdb.h> 
#include <netinet/in.h>
#include <unistd.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h> 
#include <sys/types.h>
#define MAX 80
#define PORT 8082
#define SA struct sockaddr 

struct patient{           /* structure of a member going to be written to file*/
    int  patientNum;   
    char fname[10];
    char lname[10];
    char date[11];
    char gender[2];
    char category[10];
    char officer[19]; 
};


void patientDetails(int sockfd){
    char buff[60];//used to store the incoming messages
    char buff2[60];//used to store the outgoing messages.    
    char district[60];//used to store district
    char name[15];//used to store name
    int check = 0;// used to check if a criteria is matched 
    int len = 0; //length of a buff copied into a variable
    char fun[60];//choosing a function
    char fun2[60];//used to copy function into another buffer
    char func[15];//name of function e.g search, add patient, check status is copied into this variable
	char *ptr = NULL;//a pointer to the function
    char delim[] = " ";// used when splitting string based on spaces 
    char delim2[] = "";//delimitor 2 to separate string with '/0'
    char delim3[] = ",";//delimitor 3 to separate string with ','

    //AUTHENTCATE DISTRICT
    do{
        read(sockfd, buff, sizeof(buff));
        strcpy(district,buff);
       if(strcmp(buff,"kampala") == 0 ||strcmp(buff,"wakiso") == 0){
            strcpy(buff2,"valid");
            check = 1;
        }
        else{
            strcpy(buff2, "invalid");
            check = 0;
        }
        write(sockfd,buff2, sizeof(buff2));
    }while(check == 0);

    //AUTHENTICATE NAME
    do{
        //read name from socket store in buff storage
        read(sockfd, buff, sizeof(buff));
        //copy name from buffer to name variable
        strcpy(name,buff);
        //used to remove the pesky last character so as to much comparison
        len = strlen(name);
        if(name[len-1] == '\n')
            name[len-1] =0;

        //compare of name is a for valid user
        if(strcmp(name,"Kigula") == 0){
            strcpy(buff2,"Valid Name");
            check = 1;
        }
        else{
            strcpy(buff2, "falseName");
            check = 0;
        }
        write(sockfd,buff2, sizeof(buff2));
        printf("%d", check);
    }while(check == 0);

    //FUNCTIONS e.g search, check_status, addfile.
    do{
        //struct member one = {0,"","","","",""};
        //strcpy(tempdistrict,district); 

        //remove that pesky \n symbol       
        read(sockfd, buff, sizeof(buff));
        strcpy(fun,buff);
        len = strlen(fun);
        if(fun[len-1] == '\n')
            fun[len-1] =0;

        strcpy(fun2,fun);//to remain with original function
        ptr = strtok(fun2,delim);//copy of function to modify and work with
        strcpy(func,ptr);
        ptr = strtok(NULL,delim2);
    
        //add patient if
        if(strcmp(func,"Addpatient") == 0){

        }

              
    }while(strcmp(fun,"exit") != 0);

}

int main(){
    int sockfd, connfd, len;
    struct sockaddr_in servaddr, cli;

    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if(sockfd == -1){
        printf("socket creation failed... \n");
        exit(0);
    }
    else
        printf("Socket successfully created..\n");
    bzero((&servaddr), sizeof(servaddr));

    // assign IP, PORT 
	servaddr.sin_family = AF_INET; //match socket call
	servaddr.sin_addr.s_addr = htonl(INADDR_ANY); //bind to any local address
	servaddr.sin_port = htons(PORT); //specify port to listen on. htons is a converter
   
    int tr=1;
   if(setsockopt(sockfd,SOL_SOCKET,SO_REUSEADDR,&tr,sizeof(int)) == -1){
      perror("setsockopt");
      exit(1);
   }
      
   // Binding newly created socket to given IP and verification 
	if ((bind(sockfd, (SA*)&servaddr, sizeof(servaddr))) != 0){ 
		perror("socket bind failed"); 
		exit(0); 
	} 
	else
		printf("Socket successfully binded..\n"); 

	// Now server is ready to listen and verification 
	if ((listen(sockfd, 5)) != 0) { 
	        printf("Listen failed...\n"); 
		exit(0); 
	} 
	else
		printf("Server listening..\n"); 
	len = sizeof(cli); 

	// Accept the data packet from client and verification 
	connfd = accept(sockfd, (SA*)&cli, &len); 
	if (connfd < 0) { 
		printf("server acccept failed...\n"); 
		exit(0); 
	} 
	else
		printf("server acccept the client...\n"); 

    patientDetail(connfd);

	// After chatting close the socket 
	close(sockfd);
}